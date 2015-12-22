 
$(function(){
      $('#btnGetWeather').click(function () {

       if ($('#inputCityName').val() === "") {
            return;
       }

        $("h1").hide();
        $("#btnGet").removeClass(" visiblebutton");
        $("#containerid").hide();
        $("#weatherTable th:nth-child(4n+2)").show();
        $("#weatherTable th:last-child").show();
        $( "#city_container").removeClass("paragalign");
        $("#visible").removeClass("unvisible");
        $("#visible").addClass("weather_form");
         $("#weatherTable").removeClass(" displayinline");
        $("#weatherTable").show();
   
       getWeatherByCity('ua', dataReceived, showError, $('#inputCityName').val());
    });


    $('#inputCityName').keypress(function(e) {
        var ENTER_KEY_CODE = 13;
        if ( e.which === ENTER_KEY_CODE ) 
        {
            $('#btnGetWeather').trigger('click');
            return false;
        }
    });

    function dataReceived(data) {
        offset = (new Date()).getTimezoneOffset()*60*1000; // Відхилення від UTC в секундах
        city = data.city.name;
        var country = data.city.country;
        arrDay = [];
        arrTime = [];
    

        $("#weatherTable tr:not(:first)").remove();
        $.each(data.list, function(){
            // "this" тримає об'єкт прогнозу звідси: http://openweathermap.org/forecast16
            var localTime = new Date(this.dt*1000 - offset); // конвертуємо час з UTC у локальний
            var tempDay = Math.round(this.temp.day) + ' &deg;c';
            var tempNight = Math.round(this.temp.night) + ' &deg;c';
            var localTimeDay = new Date(this.dt*1000 - offset);
            
            arrDay.push(Math.round(this.temp.day));
            arrDay.push(Math.round(this.temp.night));
            arrTime.push(localTime.getDate());
            moment.locale('uk');   

             addWeather( 
                moment(localTime).format('ll'),   // Dec 15, 2015 // 12/05/2015          
                moment(localTimeDay).format('dddd'),	// Використовуємо moment.js для представлення дати
                this.weather[0].icon,
                tempDay,
                tempNight,
                this.humidity + ' &#37',
                this.weather[0].description
             );
        });

        $('#location').html('<b>' + city + ", " +  country + '</b>'); // Додаємо локацію на сторінку
                   
                $( "div#chart" ).html('');
                var height = 241,
                width = 450,
                barWidth = 40,
                barOffset = 5,
                tempColor;

                var tooltip = d3.select('body').append('div')
                    .style('position', 'absolute')
                    .style('padding', '0 10px')
                    .style('background', 'white')
                    .style('color', 'black')
                    .style('opacity', 0)

                var colors = d3.scale.linear()
                    .domain([-20, -10, 0, 10, 20, 30])
                    .range(['blue','rgb(60,164,198)','violet','yellow','orange','red']);


                var yScale = d3.scale.linear()
                        .domain([-30, 40])
                        .range([0, height-40]);

                var xScale = d3.scale.ordinal()
                        .domain(d3.range(0, arrDay.length))
                        .rangeBands([0, width],.2,0)

                var margin = { top: 30, right: 30, bottom: 40, left:50 }

                var myChart = d3.select('#chart').append('svg')
                    .style('border', '1px solid white')
                    .attr('width', width + margin.left + margin.right)
                    .attr('height', height + margin.top + margin.bottom)
                    .append('g')
                    .attr('transform', 'translate('+ margin.left +', '+ margin.top +')')
                    .selectAll('rect').data(arrDay)
                    .enter().append('rect')
                        .style('fill', colors)
                        .attr('width', xScale.rangeBand())
                        .attr('x', function(d,i) {
                            return xScale(i);
                        })
                        .attr('height', 0)
                        .attr("y", height)

                        .on('mouseover', function(d) {
                            
                            tooltip.transition()
                            .style('opacity', .9)
                            tooltip.html(d)
                                .style('left', (d3.event.pageX - 35) + 'px')
                                .style('top',  (d3.event.pageY - 30) + 'px')

                            tempColor = this.style.fill;
                            d3.select(this)
                                .style('opacity', .5)
                                .style('fill', 'yellow')
                        })

                        .on('mouseout', function(d) {
                            d3.select(this)
                                .style('opacity', 1)
                                .style('fill', tempColor)
                        
                        tooltip.html(d)

                                .style('opacity', 0)

                        })

                myChart.transition(3000)
                        .attr('height', function(d) {
                        return yScale(d);
                        })  
                        .attr("y", function(d) {
                            return height - yScale(d);
                        })
                        .delay(function(d,i) {
                            return i *250;
                        })
                        .duration(3000)
                        .ease('elastic')



                 var vGuideScale = d3.scale.linear()
                    .domain([-30, 50])
                    .range([height,0])

                var vAxis = d3.svg.axis()
                    .scale(vGuideScale)
                    .orient('left')
                    .ticks(7)

                var vGuide = d3.select('svg').append('g')
                    vAxis(vGuide)

                    vGuide.attr('transform', 'translate(' + margin.left + ', ' + margin.top + ')')
                    .style('color','white')
                    vGuide.selectAll('path')
                    .style('color','white') 
                    .style({fill: 'none', stroke: "white"})
                    vGuide.selectAll('line')
                    .style({stroke: "white"})

                var hAxis = d3.svg.axis()
                    .scale(xScale)
                    .orient('bottom')
                    .tickValues(xScale.domain())

                var hGuide = d3.select('svg').append('g')
                    hAxis(hGuide)
                    hGuide.attr('transform', 'translate(' + margin.left + ', ' + (height + margin.top) + ')')
                    hGuide.selectAll('path')
                        .style({ fill: 'none', stroke: "white"})
                    hGuide.selectAll('line')
                        .style({ stroke: "white"})
                }

    function addWeather( day,localTimeDay,icon, tempDay, tempNight,humidity,  condition){
        var markup = '<tr>'+
                '<td>' + day + '</td>' +
                '<td>' + localTimeDay + '</td>' +
                '<td>' + '<img src="resources/img/icons/'+ 
                  icon
                  +'.svg" />' + '</td>' +
                '<td class="tempDay">' + tempDay + '</td>' +
                '<td class="tempNight">' + tempNight + '</td>' +
                '<td>' + humidity + '</td>' +
                '<td>' + condition + '</td>'
            + '</tr>';
        weatherTable.insertRow(-1).innerHTML = markup;        // Додаємо рядок до таблиці
    }

    function showError(msg){
        $('#error').html('Сталася помилка: ' + msg);
    }
});



 



function myWeather () {
        $("#weatherTable").toggleClass(" displayinline");
        $("#weatherTable td:nth-child(4n+2)").toggle();
        $("#weatherTable th:nth-child(4n+2)").toggle();
        $("#weatherTable th:last-child").toggle();
        $("#weatherTable td:last-child").toggle();
        $( "#containerid").toggle();
        $( "#city_container").toggleClass("paragalign");
        $( "#chart").toggleClass();
}
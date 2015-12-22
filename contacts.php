<?php include "process.php"; ?>

<!DOCTYPE html>
<html lang="ua">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="vendors/css/normalize.css">
	<link rel="stylesheet" href="vendors/css/ionicons.css">
	<link rel="stylesheet" href="vendors/css/col.css">
	<link rel="stylesheet" href="resources/css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<title>Weather-info forecast</title>
</head>
<body>
<div class="background_container">
	<header>	<!-- HEADER -->
		<nav class="row">
		<a href="index.html"><img class="logo" src="resources/img/logo-white.png" alt="Weather-info logo"></a>
			<ul class="page_nav">
				<li>
					<a href="index.html">Головна</a>
				</li>
				<li>
					<a href="about.html">Про сайт</a>
				</li>
				<li>
					<a href="contactsnew.php">Контакти</a>
				</li>
			</ul>
		</nav>
	</header> 	<!-- /HEADER -->

	<main class="row">		<!-- MAIN -->
				<h2>Контакти</h2>
				<div class="line"></div>
				<?php if (isset($msg)) { echo '<div id="formmessage"><p>', $msg , '</p></div>'; } ?>	
	<form id="myform" name="theform" class="group span_3_of_4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<fieldset title="Login Info" class="general_info">
		
		<span class="formerror"></span>
		<ol>
			<li>
				<label for="myname">Ім'я <span>*</span></label>
				<input type="text" name="myname" id="myname" autofocus  placeholder="Ім'я" 
				value="<?php if (isset($myname)) {echo $myname;} ?>" />
				<?php if (isset($err_myname)) { echo $err_myname; } ?>
				
			</li>
			<li>
				<label for="myemail">Email <span>*</span></label>
				<input type="text" name="myemail" id="myemail" value="<?php if (isset($myemail)) { echo $myemail; } ?>"  />
				<?php if (isset($err_patternmatch)) { echo $err_patternmatch; } ?>
			</li>
			<li>
				<label for="mylist">Як дізнались про сайт? </label>
				 <input type="list" list="answer" id="mylist" name="mylist" value="<?php if (isset($mylist)) { echo $mylist; } ?>"/>
					<datalist id="answer">
					<option value="Від знайомих"/>
					<option value="Через соціальні мережі"/>
					<option value="Через пошукові системи"/>
					</datalist>
					<?php if (isset($err_mylist)) { echo $err_mylist; } ?> 
			</li>
		</ol>
	</fieldset>
	<fieldset title="Comments" class="comments">
	
		<ol>
			<li>
				<div class="grouphead">Тип запиту</div>
				<ol>
					<li>
						<input type="radio" name="requesttype" value="question" id="questionitem" <?php if ((isset($requesttype)) && ($requesttype==='question')) { echo "checked"; } ?> />
						<label class="light" for="questionitem">запитання</label>
					</li>
					<li>
						<input type="radio" name="requesttype" value="comment" id="commentitem" <?php if ((isset($requesttype)) && ($requesttype === 'comment')) { echo "checked"; } ?> />
						<label class="light" for="commentitem">коментар</label>
					</li>
				</ol>
			</li>
			<li>
				<label for="mycomments">Коментар</label>
				<textarea name="mycomments" cols="30" rows="10" id="mycomments" ><?php if (isset($mycomments)) { echo $mycomments; } ?></textarea>
				
			</li>
		</ol>
	<button type="submit" name="action" value="submit">Відправити</button>
	</fieldset>
</form>

		</main>		<!-- /MAIN -->
		</div>
		<footer class="footer">		<!-- FOOTER -->
			<div class="row">
				<a href="https://itunes.apple.com">
					<button class="btn-sm">
						<i class="ion-social-apple icon-big"></i>
						<span>iOs App</span>
						
					</button>
				</a>
				<a href="https://play.google.com">
					<button class="btn-sm">
						<i class="ion-social-android icon-big"></i>
						<span >Android App
						</span>
					</button>
				</a>

				<ul class="social_network">
				<li>
					<a href="https://www.twitter.com">
						<i class="ion-social-twitter tw"></i>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com">
						<i class="ion-social-facebook f"></i>
					</a>
				</li>
				<li>
					<a href="https://plus.google.com">
						<i class="ion-social-googleplus g"></i>
					</a>	
				</li>
			</ul>
			
			<p class="copyright">2015 © Weather-info.  Усі права застережено</p>	
			</div>
			
			
		</footer>	<!-- /FOOTER -->
<script src="form_validation.js"></script>
</body>
</html>
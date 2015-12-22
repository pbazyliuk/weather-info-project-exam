<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):

	/*$myname = $_POST['myname'];
	$myemail = $_POST['myemail'];
	$mylist = $_POST['mylist'];*/
if (isset($_POST['myname'])) { $myname = $_POST['myname']; }
if (isset($_POST['myemail'])) { $myemail = $_POST['myemail']; }
if (isset($_POST['mylist'])) { $mylist = $_POST['mylist']; }
if (isset($_POST['mycomments'])) { $mycomments = $_POST['mycomments']; }
if (isset($_POST['requesttype'])) { $requesttype = $_POST['requesttype']; }
if (isset($_POST['$err_patternmatch'])) { $err_patternmatch = $_POST['$err_patternmatch']; }	

	$formerrors = false;

	if ($myname === '') :
		$err_myname = '<div class="error">Будь-ласка, введіть ваше ім\'я</div>';
		$formerrors = true;
	endif; // input field empty

	if ( !(preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $myemail)) ) :
		$err_patternmatch = '<div class="error">Будь-ласка, перевірте введений формат email</div>';
		$formerrors = true;
	endif; // pattern doesn't match

	/*if ($mylist === '') :
		$err_mylist = '<div class="error">Sorry, your name is a required field</div>';
	endif; // input field empty*/

	$formdata = array (
    'myname' => $myname,
    'myemail' => $myemail,
    'mylist' => $mylist,
    'mycomments' => $mycomments,
   /* 'requesttype' => $requesttype*/ 
    );

	if (!($formerrors)) :
		$to				= 	"youremail@yourdomain.com";
		$subject	=		"From $myname -- Signup Page";
		$message	=		json_encode($formdata);

		$replyto	=		"From: fromprocessor@iviewsource.com \r\n".
									"Reply-To: donotreply@iviewsource.com \r\n";

		if (mail($to, $subject, $message)):
			$msg = "Дякуємо, ваші дані відправлено!";
		else:
			$msg = "Проблема надсилання данних форми";
		endif; // mail form data

	endif; // check for form errors


endif; //form submitted
?>
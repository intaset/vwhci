<?php

$my_email = "vwhci@avestia.com";

/*

Enter the continue link to offer the user after the form is sent.  If you do not change this, your visitor will be given a continue link to your homepage.

If you do change it, remove the "/" symbol below and replace with the name of the page to link to, eg: "mypage.htm" or "http://www.elsewhere.com/page.htm"

*/

$continue = "/";

/*

Step 3:

Save this file (FormToEmail.php) and upload it together with your webpage containing the form to your webspace.  IMPORTANT - The file name is case sensitive!  You must save it exactly as it is named above!  Do not put this script in your cgi-bin directory (folder) it may not work from there.

THAT'S IT, FINISHED!

You do not need to make any changes below this line.

*/

$errors = array();

// Remove $_COOKIE elements from $_REQUEST.

if(count($_COOKIE)){foreach(array_keys($_COOKIE) as $value){unset($_REQUEST[$value]);}}

// Check all fields for an email header.

function recursive_array_check_header($element_value)
{

global $set;

if(!is_array($element_value)){if(preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i",$element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_header($value);}

}

}

recursive_array_check_header($_REQUEST);

if($set){$errors[] = "You cannot send an email header";}

unset($set);

// Validate email field.

if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
{
if(preg_match("/(%0A|%0D|\n+|\r+|:)/i",$_REQUEST['email'])){$errors[] = "Email address may not contain a new line or a colon";}

$_REQUEST['email'] = trim($_REQUEST['email']);

if(substr_count($_REQUEST['email'],"@") != 1 || stristr($_REQUEST['email']," ")){$errors[] = "Email address is invalid";}else{$exploded_email = explode("@",$_REQUEST['email']);if(empty($exploded_email[0]) || strlen($exploded_email[0]) > 64 || empty($exploded_email[1])){$errors[] = "Email address is invalid";}else{if(substr_count($exploded_email[1],".") == 0){$errors[] = "Email address is invalid";}else{$exploded_domain = explode(".",$exploded_email[1]);if(in_array("",$exploded_domain)){$errors[] = "Email address is invalid";}else{foreach($exploded_domain as $value){if(strlen($value) > 63 || !preg_match('/^[a-z0-9-]+$/i',$value)){$errors[] = "Email address is invalid"; break;}}}}}}

}

// Check referrer is from same site.

if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Check for a blank form.

function recursive_array_check_blank($element_value)
{

global $set;

if(!is_array($element_value)){if(!empty($element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_blank($value);}

}

}

recursive_array_check_blank($_REQUEST);

if(!$set){$errors[] = "You cannot send a blank form";}

unset($set);

// Display any errors and exit if errors exist.

if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}

if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

// Build message.

function build_message($request_input){if(!isset($message_output)){$message_output ="";}if(!is_array($request_input)){$message_output = $request_input;}else{foreach($request_input as $key => $value){if(!empty($value)){if(!is_numeric($key)){$message_output .= str_replace("_"," ",ucfirst($key)).": ".build_message($value).PHP_EOL.PHP_EOL;}else{$message_output .= build_message($value).", ";}}}}return rtrim($message_output,", ");}

$message = build_message($_REQUEST);

$message = $message . PHP_EOL.PHP_EOL."-- ".PHP_EOL."";

$message = stripslashes($message);

$subject = $_REQUEST['Subject'];

$headers = "From: " . $_REQUEST['Email'];

mail($my_email,$subject,$message,$headers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noarchive">
<meta name="description" content="{{page.meta}}">
<meta name="keywords" content="{{page.keyword}}">
<title>Avestia Publishing - Thank You</title>

<meta name="handheldfriendly" content="true">
<meta name="mobileoptimized" content="240">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="css/avestia.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
<!--[if IE-9]><html lang="en" class="ie9"><![endif]-->

<script src="js/modernizr.custom.63321.js"></script>
<script>
  (function() {
    var cx = '016656741306535874023:f_iiykae6ri';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
</head>

<body class="loading">
<nav id="slide-menu">
  <h1>Avestia Publishing</h1>
  <ul>
    <li><a href="about">About Us</a></li>
    <li><a href="ethics">Ethics in Publishing</a></li>
    <li><a href="openaccess">Open Access</a></li>
    <li><a href="editor">Become a Reviewer or an Editor</a></li>
    <li><a href="publishing">Your Publishing Needs</a></li>
    <li><a href="proceedings">Conference Proceedings</a></li>
    <li><a href="news">Latest News</a></li>
    <li><a href="guidelines">Author Guidelines</a></li>
    <li><a href="journals">Journals</a></li>
    <li><a href="http://amss.avestia.com/">Submission</a></li>
    <li><a href="copyright">Copyright</a></li>
    <li><a href="contact">Contact Us</a></li>
  </ul>
</nav>

<div id="content">
  <div class="cbp-af-header">
  <div class="cbp-af-inner">
    <a href="/"><img src="img/logo.svg" class="flex-logo" alt="Avestia Publishing"></a>

    <div class="nav1">
      <nav>
        <a href="/">Home</a>
        <a href="http://amss.avestia.com/">Submission</a>
        <a href="journals">Journals</a>
        <a href="ethics">Ethics in Publishing</a>
        <a href="guidelines">Author Guidelines</a>
      </nav>
    </div>

    <div class="search-menu">
      <gcse:searchbox-only resultsUrl="results"></gcse:searchbox-only> <div class="menu-trigger-1"><p class="menu">MENU</p></div>
    </div>

    <div class="nav">
      <nav>
        <a href="/">Home</a>
        <a href="http://amss.avestia.com/">Submission</a>
        <a href="journals">Journals</a>
        <a href="ethics">Ethics in Publishing</a>
        <a href="guidelines">Author Guidelines</a>
      </nav>
    </div>
  </div>
</div>

  <header>
    <div class="mobile">
      <div class="cbp-af-header">
	<div class="cbp-af-inner">
		<div class="unit unit-s-3-4 unit-m-1-3 unit-l-1-3">
      		<a href="/"><img src="img/logo.svg" class="flex-logo" alt="Avestia Publishing"></a>
   	 	</div>
    	<div class="unit unit-s-1-3 unit-m-2-3 unit-m-2-3-1 unit-l-2-3">
      		<div class="menu-trigger"><p class="menu">MENU</p></div>
  		</div>
	</div>
</div>
      <div class="bg">
        <gcse:searchbox-only resultsUrl="results"></gcse:searchbox-only>
      </div>
    </div> <!-- Mobile -->
  </header>

  <div class="grid">
    <div class="unit unit-s-1 unit-m-1 unit-l-1">
  <div class="main-content content php">
   <h2>Contact Avestia Publishing</h2>
   <p class="body">Thank you for your message!</p>
   <p class="body">We have received your message and will get back to you within the next 48 hours.</p>

   <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
    <p class="body">&nbsp;</p>
  </div>
</div>
</div>

<footer>
<div class="grid">
  <div class="unit unit-s-1 unit-s-1-3 unit-m-1-3 unit-l-1-3">
    <div class="unit-spacer">
      <ul class="footer-links">
        <li><a href="/" class="body-link">Avestia Publishing</a></li>
        <li><a href="journals" class="body-link">Journals</a></li>
        <li><script>var refURL = window.location.protocol + "//" + window.location.host + window.location.pathname; document.write('<a href="http://international-aset.com/feedback/?refURL=' + refURL+'">Feedback</a>');</script></li>
        <li><a href="terms" class="body-link">Terms of Use</a></li>
        <li><a href="sitemap" class="body-link">Sitemap</a></li>
      </ul>
    </div>
  </div>

  <div class="unit unit-s-1 unit-s-1-3 unit-m-1-3 unit-l-1-3">
    <div class="unit-spacer">
      <p class="body">
        Avestia Publishing,<br>
        International ASET Inc.<br>
        Unit 417, 1376 Bank St.<br>
        Ottawa, ON, Canada, K1H 7Y3<br>
        +1 613-695-3040<br>
        <a href="mailto:info@avestia.com" class="body-link">info@avestia.com</a>
      </p>
    </div>
  </div>

  <div class="unit unit-s-1 unit-s-1-3 unit-m-1-3 unit-l-1-3">
    <div class="unit-spacer social">
    <form class="subscribe" action="../subscribe.php" method="post">
            <span id="sprytextfield2"><input name="email" type="text" id="email" value="Join our mailing list"
              onblur="if (this.value == '') {this.value = 'Join our mailing list';}"
        onfocus="if (this.value == 'Join our mailing list') {this.value = '';}" ></span>
      <input type="submit" name="submit" value="Submit" class="form_button" />
        </form>
        
      <div class="unit unit-s-1-1 unit-m-1-1 unit-l-1-1">
        <a href="https://www.facebook.com/pages/International-Academy-of-Science-Engineering-and-Technology/207827708283" target="blank" title="International ASET Inc. Facebook Page">
          <img src="img/fb.png" border="0" onmouseover="this.src='img/fb-hover.png'" onmouseout="this.src='img/fb.png'">
        </a>
      </div>

      <div class="unit unit-s-1-1 unit-m-1-1 unit-l-1-1">
        <a href="https://twitter.com/ASET_INC" target="blank" title="International ASET Inc. Twitter">
          <img src="img/twitter.png" border="0" onmouseover="this.src='img/twitter-hover.png'" onmouseout="this.src='img/twitter.png'">
        </a>
      </div>

      <div class="unit unit-s-1-1 unit-m-1-1 unit-l-1-1">
        <a href="https://www.linkedin.com/company/1169039" target="blank" title="International ASET Inc. LinkedIn">
          <img src="img/linkedin.png" border="0" onmouseover="this.src='img/linkedin-hover.png'" onmouseout="this.src='img/linkedin.png'">
        </a>
      </div>

      <div class="unit unit-s-1-1 unit-m-1-1 unit-l-1-1">
        <a href="https://plus.google.com/u/0/+International-aset/posts" target="blank" title="International ASET Inc. Google+ Page">
          <img src="img/google.png" border="0" onmouseover="this.src='img/google-hover.png'" onmouseout="this.src='img/google.png'">
        </a>
      </div>

      <p class="body">© Copyright 2015, International ASET Inc. – All Rights Reserved.</p>
    </div>
  </div>

</div>
</footer>
</div>


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/cbpAnimatedHeader.min.js"></script>
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

    <script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>

    <script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<script src="js/classie.js"></script>
<script src="js/jquery.easing.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script defer src="js/demo.js"></script>
<script type="text/javascript" src="css/animate.min.css"></script>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1"});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield6");
//-->
</script>

    <script type="text/javascript">
/*
  Slidemenu
*/
(function() {
  var $body = document.body
  , $menu_trigger = $body.getElementsByClassName('menu-trigger')[0];

  if ( typeof $menu_trigger !== 'undefined' ) {
    $menu_trigger.addEventListener('click', function() {
      $body.className = ( $body.className == 'menu-active' )? '' : 'menu-active';
    });
  }

}).call(this);
</script>

<script type="text/javascript">
/*
  Slidemenu
*/
(function() {
  var $body = document.body
  , $menu_trigger = $body.getElementsByClassName('menu-trigger-1')[0];

  if ( typeof $menu_trigger !== 'undefined' ) {
    $menu_trigger.addEventListener('click', function() {
      $body.className = ( $body.className == 'menu-active' )? '' : 'menu-active';
    });
  }

}).call(this);
</script>

</body>
</html>

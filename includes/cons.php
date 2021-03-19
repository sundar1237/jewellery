<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'funcs/db.php';

define("MAIN_TITLE", "Saran Solutions");
define("PROGRAM_TITLE", "Jewellery Invoice System");
define("MAIN_LOGO_PATH", "images/logo.png");

#mail parameters
define("SEND_MAIL", True);
define("SMTP_HOST", "lx16.hoststar.hosting");
define("SMTP_PORT", "587");
define("MAIL_FROM_ADDRESS", "info@fimmoag.com");
define("MAIL_TO_ADDRESS", "info@fimmoag.com");

function getMeta(){
    return '<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="saransolutions.ch">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Jekyll v4.1.1">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">';
}

function getLinksFavICon(){
    return '
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">';
}

function getCssLinks(){
    return '
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--<link href="css/carousel.css" rel="stylesheet">
<link href="css/blog.css" rel="stylesheet">-->';
}

function getHead($title,$customLinks,$directStyle){
    return getMeta().'<title> '.MAIN_TITLE.' | '.$title.'</title>'.getLinksFavICon().''.$directStyle.'
    </style>
    <!-- Custom styles for this template -->
'.getCssLinks().$customLinks;
    
}


function getNavigationMenu(){
    return '<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><img class="img-fluid" src="images/logo_saran.png"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Invoices<span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="receivers.php">Monthly Schemes</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="customers.php">Customers</a>
      </li>
    </ul>    
  </div>
</nav>
</header>';
}

function getFooter(){
    return '<!-- FOOTER -->
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; Saran Solutions CH. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
<!-- FOOTER -->';
}

function getJavaScript(){
    return '<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/typeahead.bundle.js" type="text/javascript"></script>
	<script src="js/jquery.cookie.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

';
}

?>
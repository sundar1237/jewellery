<?php
include 'includes/cons.php';
if (! isset($_SESSION['user'])) {
    include_once 'funcs/login.php';
    displayLoginPage('');
}else if (isset($_GET['action']) && "addAgent" == $_GET['action']) {
    include 'funcs/customer.php';
    //header('Location: index.php');
}else{
    include_once 'includes/pageAgent.php';
}?>
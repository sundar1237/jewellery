<?php
include 'includes/cons.php';
if (! isset($_SESSION['user'])) {
    include_once 'funcs/login.php';
    displayLoginPage('');
}else if (isset($_GET['action']) && "add" == $_GET['action']) {
    include 'funcs/customer.php';
    //header('Location: index.php');
}else if (isset($_GET['action']) && "showRate" == $_GET['action']) {
    include 'funcs/exchange/helper.php';
    echo getExchangeRates();
}else if (isset($_POST['action']) && "update_rates" == $_POST['action']) {
    include 'funcs/exchange/helper.php';
    echo updateExchangeRates();
    header('Location: exchange.php');
}else if (isset($_POST['scur']) && isset($_POST['rcur'])) {
   echo getSingleValue("select transfer from  xchange where scur='".$_POST['scur']."' and rcur='".$_POST['rcur']."' ");
    //header('Location: index.php');
}else{
    include_once 'includes/pageExchange.php';
}?>
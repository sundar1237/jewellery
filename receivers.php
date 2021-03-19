<?php
include 'includes/cons.php';
if (! isset($_SESSION['user'])) {
    include_once 'funcs/login.php';
    displayLoginPage('');
}else if (isset($_GET['action']) && "showFormToAddReceiver" == $_GET['action']) {
    $id=$_GET['id'];
    include 'funcs/customer.php';
    echo showFormToAddReceiver($id);
    //header('Location: index.php');
}else if (isset($_POST['action']) && "add_receiver" == $_POST['action']) {
    include 'funcs/customer.php';
    addReceiver();
    $page = $_SERVER['HTTP_REFERER'];
    if (strpos($page, 'customers.php') !== false) {
        header('Location: receivers.php');
    }else{
        header('Location: index.php?action=showsendMoneyForm');
    }    
}else if (isset($_POST['action']) && "getReceiverName" == $_POST['action']) {
    $receiverId=$_POST['id'];
    echo $receiverId."-".getSingleValue("SELECT concat(concat(rxr_first_name,' '), COALESCE(rxr_last_name,' '))c1 FROM rxr_customer WHERE id=".$receiverId);
}/* else if (isset($_POST['action']) && "getReceiverName" == $_POST['action']) {
    $receiverId=$_POST['id'];
    echo getSingleValue("SELECT concat(rxr_first_name, COALESCE(rxr_last_name,''))c1 FROM rxr_customer WHERE id=".$receiverId);
} */else{
    include_once 'includes/pageReceiver.php';
}?>
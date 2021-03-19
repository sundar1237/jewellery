<?php
include 'includes/cons.php';
if (isset($_POST['action']) && "verifyUser" == $_POST['action']) {
    include 'funcs/Utils.php';
    verifyUser();
}else if (! isset($_SESSION['user'])) {
    include_once 'funcs/login.php';
    displayLoginPage('');
}else if (isset($_GET['action']) && "showNewOrderForm" == $_GET['action']) {
    //include 'funcs/order/order.php';
    //header('Location: index.php');
}else if (isset($_GET['action']) && "markDone" == $_GET['action']) {
    $id=$_GET['id'];
    include 'funcs/order/helper.php';
    markDone($id);
    header('Location: index.php');
}else if (isset($_GET['action']) && "export" == $_GET['action']) {
    include 'exportOrder.php';
    //header('Location: index.php');
}else if (isset($_GET['action']) && "showsendMoneyForm" == $_GET['action']) {
    
    include 'funcs/order/order.php';
    
    //header('Location: index.php');
}else if (isset($_POST['action']) && "sendMoney" == $_POST['action']) {
    include 'funcs/order/helper.php';
    $id = insertCustomerOrder();
    header('Location: index.php?id='.$id);
}else if (isset($_POST['action']) && "getAllOrders" == $_POST['action']) {
    $customerId=$_POST['id'];
    include 'funcs/order/helper.php';
    echo getAllReceiversByCustomerId($customerId);
}else if (isset($_GET['id'])) {
    include_once 'includes/pageSingleOrder.php';
}else{
    include_once 'includes/pageIndex.php';
}?>
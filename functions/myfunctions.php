<?php
session_start();
include('../config/dbcon.php');

function getAll($table){
    global $con;
    $query= "SELECT * from $table";
    return $query_run = mysqli_query($con,$query);
}

function getById($table,$id){
    global $con;
    $query= "SELECT * from $table where id='$id' ";
    return $query_run = mysqli_query($con,$query);
}

function getAllActive($table){
    global $con;
    $query= "SELECT * from $table where status='1'  ";
    return $query_run = mysqli_query($con,$query);
}

function checkTrackingNoValid($trackingNo){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query= "SELECT * from orders where tracking_no='$trackingNo'  ";
    return $query_run = mysqli_query($con,$query);

}

function getAllOrders(){
    global $con;
    $query = "SELECT * from orders where status='0' ";
    return $query_run = mysqli_query($con,$query);
}

function getOrderHistory(){
    global $con;
    $query = "SELECT * from orders where status!='0' ";
    return $query_run = mysqli_query($con,$query);
}


function redirect($url,$message){
    
    $_SESSION['message']=$message;
    header('Location: '.$url);
    exit();
}

?>
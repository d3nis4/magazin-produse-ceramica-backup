<?php

$host= "localhost";
$username= "root";
$password= "";
$database= "ceramica";

//CREATING database connection
$con= mysqli_connect($host,$username,$password,$database);

//check db connection
if(!$con){
    die("Connection Failes: ". mysqli_connect_error());
}
else
{
   
}


?>
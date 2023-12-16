<?php

include('../functions/myfunctions.php');

if(isset($_SESSION['auth'])){
    
    if($_SESSION['role_as'] != 1){

        redirect("../index.php","Acces interzis");
    
    }

}
else{

    redirect("../login.php","Login to continue");
    
}
                   // part6//
?>
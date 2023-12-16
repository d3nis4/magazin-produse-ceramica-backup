<?php

if(!isset($_SESSION['auth'])){
    redirect("login.php","Conecteaza-te pentru a continua");
}

?>
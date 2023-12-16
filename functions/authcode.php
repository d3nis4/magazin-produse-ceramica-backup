<?php

session_start();

include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['register_btn'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $prenume = mysqli_real_escape_string($con,$_POST['prenume']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
   
    //verificam daca email-ul exista deja
    $check_email_query= " SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run= mysqli_query($con,$check_email_query);

    if(mysqli_num_rows($check_email_query_run)>0){
        $_SESSION['message']= "Adresa de email are deja cont";
        header('Location: ../login.php');
    }
    else{

        //verificam daca parola introdusa a doua oara este = cu prima
        if($password == $cpassword)
        {  
            // insert user in db

            $insert_query= "INSERT INTO users (name,prenume,email,password) VALUES('$name','$prenume','$email','$password')";
            $insert_query_run= mysqli_query($con,$insert_query);

            if($insert_query_run)
            {
                $_SESSION['message'] = "registered Succes";
                header('Location: ../index.php');
            }
            else{
                $_SESSION['message'] = "smth went wrong";
                header('Location: ../register.php');
            }
        }
        else{
            $_SESSION['message']="Parolele nu se potrivesc";
            header('Location: ../register.php');
        }

    }

}
else if(isset($_POST['login_btn'])){
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run= mysqli_query($con,$login_query);

    if(mysqli_num_rows($login_query_run)>0){
        
        $_SESSION['auth']=true;

        $userdata = mysqli_fetch_array($login_query_run);
        $userid = $userdata['id'];
        $username=$userdata['name'];
        $useremail=$userdata['email'];
        $role_as=$userdata['role_as'];

        $_SESSION['auth_user']=[
            'user_id' => $userid,
            'name' => $username,
            'email' => $useremail
        ];

        $_SESSION['role_as']=$role_as;

        if($role_as == 1){

            redirect("../admin/index.php","Bine ai revenit!");
        }
        else{
            redirect("../index.php","Conectat cu succes!");
        
        }
    }
    else{

        redirect("../login.php","Datele introduse sunt incorecte");
    
    }

}

?>
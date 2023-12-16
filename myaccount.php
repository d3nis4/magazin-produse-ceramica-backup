<?php 

include('functions/userfunctions.php'); 
include('config/dbcon.php');

include('authenticate.php');


$id_utilizator = $_SESSION['auth_user']['user_id'];

$result = getIDActive("users", $id_utilizator);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["id"];
    $name = $row["name"];
    $prenume = $row["prenume"];
    $phone= $row["phone"];
    $email = $row["email"];
    $adress = $row["adress"];
    $pincode = $row["pincode"];
    
} else {
    echo "Eroare la obținerea datelor utilizatorului activ.";
}
?>


<!DOCTYPE html>
<html>
<head><!DOCTYPE html>
    <html lang="en">
    
    <head>

<meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceramica</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!--- Alertify-Js --->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
    
    <body>
    
    <section id="header">
        <a href="index.php"><img src="img/logo.png" height="75"></a>
        <form class="form-inline my-2 my-lg-0" action="produseSearch.php" method="GET">
            <input class="form-control mr-sm-2 mt-10" name="search_query" type="search" placeholder="Cauta..." aria-label="Search" style="background-color: #192655;">
            <button class="normal" type="submit">Search</button>
        </form>
        <div>
            <ul id="nvbar">
                
                <li><a  href="index.php">Acasă</a></li>
                
                <li><a href="categorii.php">Categorii produse</a></li>
                
                <?php
                if(isset($_SESSION['auth'])){
                    ?>
                    
                    
                    <li><a class="active" href="myaccount.php"><i class="far fa-user"></i>
                    <?= $_SESSION['auth_user']['name']; ?></li>
                    <li><a href="logout.php">Deconectează-te</a></li>
                    <?php
                }
                else{
                    ?>
                    <li><a  href="login.php"><i class="far fa-user"></i>Conectează-te</a></li> 
                    <?php
                }
                
                ?>

                 
                <li>
                    <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">Despre noi</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="feedback.php">Recenzii</a></li>
                        </ul>
                    </div>
                </li> 
                <li id="lg-bag"><a href="cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>
            
        </div>
        
        <div id="mobile">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>
    
      
    <div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/user-code.php" method="POST">
                    <div class="row justify-content-center"> 
                        <div class="col-md-7">
                        <div class="d-flex justify-content-between">
                            <h5 class="float-start mt-2">Detalii cont</h5>
                            <a href="my-orders.php" class="btn btn-primary float-end">Comenzile Mele</a>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?> ">
                                    <label class="fw-bold">Nume</label>
                                    <input type="text" name="name" value=" <?= $name ?>"  required placeholder="Introdu numele" class="form-control">
                                    <small class="name-error text-danger"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Prenume</label>
                                    <input type="text" name="prenume" value=" <?= $prenume ?>"  required placeholder="Introdu prenumele" class="form-control">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Telefon</label>
                                    <input type="text" name="phone" id="phone" value=" <?= $phone ?>" required placeholder="Introdu numarul de telefon" class="form-control">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Cod postal</label>
                                    <input type="text" name="pincode" id="pincode" value=" <?= $pincode ?>" required placeholder="Introdu codul postal" class="form-control">
                                    <small class="text-danger pincode"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Adresa</label>
                                    <textarea name="adress" id="adress" rows="5" class="form-control"><?= $adress ?></textarea>
                                    <small class="text-danger adress"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input type="email" name="email" value=" <?= $email?>" id="email" required placeholder="Introdu noul mail" class="form-control">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Parola</label>
                                    <input type="password" name="password" value=" <?= $password?>" id="password" required placeholder="Introdu parola noua" class="form-control">
                                    <small class="text-danger"></small>
                                </div>
                                
                            </div>
                            <div class="mt-3">
                                <button type="submit"  name="updateProfileBtn" class="btn btn-primary">Actualizează datele</button>
                                  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




        <!--Newsletter-->
        <section id="newsletter" class="section-p1 section-m1"> 
                <div class="newstext">
                    <h4 style="text-align: center;">Inscrie-te pentru newsletter</h4>
                    <p>Daca doriti sa primiti informatii in legatura cu cele mai recente noutati si <span>oferte</span>, va rugam sa completati adresa dumneavoastra de email.</p>
                </div>
                <form action="functions/user-" method="POST">
                    <div class="form" >
                        <input type="text" name="newsletterEmail" placeholder="Scrie aici adresa ta de email">
                        <button type="submit" name="newsletterBtn" class="normal">Inscrie-te</button>
                    </div>
                </form>
                
         </section>

        <!--Footer-->
        <footer class="section-p1">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="logo" src="img/logo.png" style="width: 300px;">
                <h4>Contact</h4>
                <p><strong>Adresa </strong> 2201 Hotel Cir S, San Diego, CA 92108</p>
                <p><strong>Telefon: </strong> +01 2222 365</p>
                <p><strong>Program: </strong>Luni - Vineri: 10:00 - 16:00</p>
                <div class="follow">
                    <h4>Retele de socializare</h4>
                    <div class="icon">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a> 
                        <a href="https://twitter.com/?lang=ro" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/vintage.newhome/?hl=ro" target="_blank"><i class="fab fa-instagram"></i></a> 
                        <a href="https://ro.pinterest.com/search/pins/?q=ceramics&rs=typed" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h4>Informatii utile</h4>
                <p><a href="#" onclick="window.location.href='about.php';">Despre noi</a></p>
                <p><a href="#">Informatii despre transport</a></p>
                <p><a href="#">Politica de confidentialitate</a></p>
                <p><a href="#">Termeni si conditii</a></p>
                <p><a href="#" onclick="window.location.href='contact.php';">Contact</a></p>
            </div>

            <div class="col-md-4">
                <h4>Contul meu</h4>
                <p><a href="login.php" target="_blank">Conecteaza-te</a></p>
                <p><a href="#">Cosul de cumparaturi</a></p>
                <p><a href="#">Lista de dorinte</a></p>
                <p><a href="#">Urmareste comanda</a></p>
                <p><a href="#">Ajutor</a></p>
            </div>
        </div>
    </div>
</footer>

    
        <script src="script.js"></script>
    

    
<!--Alertify Js JavaScript -->
<script src="assets/js/custom.js"></script>
             
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <Script>   
            alertify.set('notifier','position', 'top-right');
        <?php 
            if(isset($_SESSION['message']))
            { 
                ?>
                alertify.success('<?= $_SESSION['message']; ?>');
                <?php 
                unset($_SESSION['message']);

            } 
        ?>
</script>
    
</body>
</html>
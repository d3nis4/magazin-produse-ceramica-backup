<?php 
include('functions/userfunctions.php'); 
include('config/dbcon.php');

if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    header("Location: produseSearch.php?search_query=" . urlencode($search_query));
    exit;
}

?>


<!DOCTYPE html>
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
            <input class="form-control mr-sm-2 mt-10" name="search_query" type="search" placeholder="Cauta..." aria-label="Search" style="background-color: #192655; color: white;">
            <button class="normal" type="submit">Search</button>
        </form>
        <div>
            <ul id="nvbar">
                
                <li><a class="active" href="index.php">Acasă</a></li>
                
                <li><a href="categorii.php">Categorii produse</a></li>
                
                <?php
                if(isset($_SESSION['auth'])){
                    ?>
                    
                    
                    <li><a  href="myaccount.php"><i class="far fa-user"></i>
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

    <?php if(isset($_SESSION['message'])) 
                { ?>
                
                        <!---<div class="alert alert-warning alert-dismissible fade show" role="alert" style=" color: #F0F0F0; position: center; margin: auto">
                        <strong>Ups!</strong> //<?php echo $_SESSION['message']; ?> -->
                        <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>-->
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>

    <section id="hero">
        <div>
            <h1>Descopera eleganta vintage!</h1>
            <h2>Adauga farmecul vintage</h2>
            <h2>in casa ta!</h2>
            <p>La comenzi de minim 150 de lei, transportul este gratuit!</p>
            <button id="buton-cumparaturi">Cumpara</button>
        </div>
    </section>

    
 <!--catgorii prod-->
<section id="product1" class="section-p1">
    <h1>Categorii de produse</h1>
    <div class="row">
        <?php
        $categories = getAllActive("categories");
        if (mysqli_num_rows($categories) > 0) {
            foreach ($categories as $item) {
                ?>
                <div class="col-md-4">
                    <a href="products.php?category=<?= $item['slug']; ?>">
                        <div class="pro">
                            <img src="uploads/<?= $item['image']; ?>"  alt="<?= $item['name']; ?>">
                            <div class="des">
                                <h5><?= $item['name'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "Nicio categorie disponibila";
        }
        ?>
    </div>
</section>


    <section id="banner" class="section-m1">
        <h2>Cine suntem?</h2>
        <h4>Cei din spatele site-ului 'Ceramica' suntem o echipă pasionată de decorul vintage, dedicați aducerii farmecului și eleganței clasice în casele oamenilor. Ne străduim să oferim produse autentice, îndrăgite de clienții noștri, și suntem aici pentru a împărtăși această pasiune cu voi.</h4>
        <button class="normal"  onclick="window.location.href='contact.php';">Contact</button>
    </section>
    
 
    <section id="product1" class="section-p1">
    <h1>Produse recomandate</h1>
    <p>Noua colecție de iarna</p>
    <div class="row">
        <?php
        $products = getAllActiveAndPopular("products");
        if (mysqli_num_rows($products) > 0) {
            foreach ($products as $item) {
                ?>
                                <div class="col-md-3">
                    <div class="pro">
                        <a href="product-view.php?product=<?= $item['slug']; ?>">
                            <img src="uploads/<?= $item['image']; ?>">
                        </a>
                        <div class="row mt-2">
                            <div class="col-8">
                                <div class="pro-details">
                                    <h6><?= $item['name'] ?></h6>
                                    <h6><?= $item['selling_price'] ?> de lei</h6>
                                </div>
                            </div>
                            <div class="col-1">
                                <input type="hidden" value="<?= $item['id'] ?>" class="prod_id">
                                        <button class="btn btn-primary  addToCartProduct" value="<?= $item['id']; ?>">
                                        <i class="fa fa-shopping-cart me-2"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Niciun produs disponibil";
        }
        ?>
    </div>
</section>





   
 <!--Newsletter-->
    <section id="newsletter" class="section-p1 section-m1"> 
        <div class="newstext">
            <h4 style="text-align: center;">Inscrie-te pentru newsletter</h4>
            <p>Daca doriti sa primiti informatii in legatura cu cele mai recente noutati si <span>oferte</span>, va rugam sa completati adresa dumneavoastra de email.</p>
        </div>
        <div style="display: flex; justify-content: center; align-items: center;">
    <form action="functions/user-code.php" method="POST">
        <div class="form" style="display: flex; flex-direction: column; align-items: center;">
            <input type="text" name="newsletterEmail" placeholder="Scrie aici adresa ta de email" style="width: 300px;">
            <button type="submit" name="newsletterBtn" class="normal" style="margin-top: 10px;">Inscrie-te</button>
        </div>
    </form>
</div>
        
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
                <p><a href="#">Urmareste comanda</a></p>
                <p><a href="#">Ajutor</a></p>
            </div>
        </div>
    </div>
</footer>

    
        <script src="script.js"></script>
    

    
<!--Alertify Js JavaScript -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>     
             
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
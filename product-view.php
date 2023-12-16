<?php 
include('functions/userfunctions.php'); 
include('config/dbcon.php');

if(isset($_GET['product'])){

    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products",$product_slug);
    $product = mysqli_fetch_array($product_data);

    
    if($product){
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
            <input class="form-control mr-sm-2 mt-10" name="search_query" type="search" placeholder="Cauta..." aria-label="Search" style="background-color: #192655;">
            <button class="normal" type="submit">Search</button>
        </form>
        <div>
            <ul id="nvbar">
                
                <li><a  href="index.php">Acasă</a></li>
                
                <li><a class="active" href="categorii.php">Categorii produse</a></li>
                
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
            
        <section id="prodetails" class="section-p1 product_data">
            
                <div class="single-pro-image">
                    <img src="uploads/<?= $product['image'];?>" width="100%" id="MainImg" alt="">
                </div>
                <div class="single-pro-details">
                   
                    <h6><span class="float-end text-danger"><?php if($product['trending']){echo "Produs Popular";}?></span></h6>
                    <h4><?= $product['name'] ?></h4>
                    <div class="row mt-3">
                        <div class="col-md-6">   
                        <input type="hidden" class="databaseQty" value="<?= $product['qty'];?>">
                        <div class="input-group mb-3" style="width:130px">   
                            <button class="input-group-text decrement-btn-prod">-</button>
                            <input type="text" class="form-control text-center input-qty bg-white" value="1">
                            <button class="input-group-text increment-btn-prod">+</button>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <h2><?= $product['selling_price'] ?> lei</h2>
                         </div>
                    </div>
                    
                    <div class="row mt-3">
                       
                        <div class="col-md-6">
                            <button class="btn btn-primary px-4 me-2 mb-2 mb-sm-0 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>Adaugă în coș</button>
                        </div>
                    </div>
                    <h4>Descrierea produsului</h4>
                    <span><?= $product['description'] ?></span>

                </div>
        </section>





            <!--Newsletter-->
            <section id="newsletter" class="section-p1 section-m1"> 
                <form action="functions/user-code.php" method="POST">
                    <div class="newstext">
                        <h4 style="text-align: center;">Lasa-ne un review</h4>
                        <p>Suntem nerabdatori sa auzim ce parere ai desrpe micul nostru magazin.</p>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Nume</label>
                        <textarea class="form-control" name="nume_parere" placeholder="Nume" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Example textarea</label>
                        <textarea class="form-control" name="parere" placeholder="Scrie-ne aici parerea ta..." rows="3"></textarea>
                    </div>             
                        <button type="submit" name="parereBtn"  class="normal" >Trimite</button>
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
            
        <?php
    }      
    else{
        echo "Produsul nu a fost gasit";
    }
}
    else{
        echo "Ceva nu a functionat";
        }
?>
</body>
</html>
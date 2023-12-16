<?php 

include('functions/userfunctions.php'); 
include('config/dbcon.php');
include('authenticate.php');


$cartItems = getCartItems();
if(mysqli_num_rows($cartItems) == 0){
    header('Location: index.php');
}

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
                <li id="lg-bag"><a class="active" href="cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>
            
        </div>
        
        <div id="mobile">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>
    
        <section id="page-header" class="about-header">
            <h2>Transportul este gratuit</h2>
            <p>pentru toate comenzile mai mari de 150 de lei</p>
        </section>
    
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                <div class="row">
                    <div class="col-md-7">
                    <div class="d-flex justify-content-between">
                        <h5 class="mt-2">Detalii comandă</h5>
                        <a href="cart.php" class="btn btn-primary">Înapoi la Coșul de Cumpărături</a>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <lable class="fw-bold">Nume</lable>
                                <input type="text" name="name" id="name" value="<?= $name . ' ' . $prenume ?>" required placeholder="Introdu tot numele" class="form-control">
                                <small class="name-error text-danger name"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <lable class="fw-bold">Email</lable>
                                <input type="email" name="email" id="email" value=" <?= $email ?>" required placeholder="Introdu adresa de email" class="form-control">
                                <small class="text-danger email"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <lable class="fw-bold">Telefon</lable>
                                <input type="text" name="phone" id="phone" value=" <?= $phone ?>" required placeholder="Introdu numarul de telefon" class="form-control">
                                <small class="text-danger phone"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <lable class="fw-bold">Cod postal</lable>
                                <input type="text" name="pincode" id="pincode" value=" <?= $pincode ?>" required placeholder="Introdu codul postal" class="form-control">
                                <small class="text-danger pincode"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable class="fw-bold">Adresa (Oraș, județ, stradă, numărul străzii): </lable>
                                <textarea name="adress" id="adress"  rows="3" class="form-control"><?= $adress ?></textarea>
                                <small class="text-danger adress"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable class="fw-bold">Comentarii</lable>
                                <textarea name="comments" id="comments" rows="2" class="form-control"></textarea>
                                <small class="text-danger comments"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Cupon reducere</label>
                                <input type="text" name="cupon" id="cupon" rows="2" class="form-control">
                                <small class="text-danger cupon"></small>
                                <button type="button" class="btn btn-primary mt-2" id="applyCouponBtn">Aplică cupon</button>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6>Produs</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Pret</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Cantitatea</h6>
                            </div>
                        </div>
                        <div id="mycart">
                            <?php 
                                $items= getCartItems();
                                $totalPrice = 0;
                                foreach($items as $citem){
                                    
                            ?>
                                    <div class="card product_data shadow-sm mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 ">
                                                <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="80px">
                                            </div>
                                            <div class="col-md-3  ml-3">
                                                <h6>    <?= $citem['name'] ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?= $citem['selling_price'] ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?= $citem['prod_qty'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                                } 
                                    $newTotalPrice=$totalPrice;
                                ?>
                                <input type="hidden" id="hiddenTotalPrice" value="<?= $totalPrice ?>">
                                <hr>
                                <div class="row">
                                <div class="col-md-6">
                                    <h6 >Valoare veche cos: <?=$totalPrice?></h6>
                                    <h6 id="newTotalPrice" style="display: none;"> Cos nou: <?=$newTotalPrice ?> </h6>
                                </div>

                                    <div class="col-md-6 text-end">
                                        <h6 class="ml-5" id="transportCost">
                                            Transport: 
                                            <?php
                                                $transport = 0;
                                                if ($newTotalPrice >= 150) {
                                                    echo "Gratuit!";
                                                } else {
                                                    $transport = 19;
                                                    echo "19 lei";
                                                } 
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                                
                                <hr>
                                <h5>Cost total: <span id="totalCost" class="text-end fw-bold" style="text-align: end;"><?= $newTotalPrice + $transport ?></span></h5>
                                <div class="" style="text-align: center;">
                                    <div class="col-md-12 mb-3">
                                        <lable class="fw-bold">Metoda de plată:</lable><br>
                                            <input type="radio"  name="payment_mode" value="cash" checked>
                                                <label for="cashOnDelivery">Plata ramburs</label><br>
                                            <input type="radio"  name="payment_mode" value="card">
                                                <label for="creditCard">Plata cu cardul</label><br>
                                    </div>
                                        <button type="submit" name="palceOrderBtn" class="btn btn-primary">Plaseaza comanda</button>
                                </div>
                                <div id="paypal-button-container" class="mt-3"></div>
                                
                        </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


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


<!-- Replace the "test" client-id value with your client-id -->
<script src="https://www.paypal.com/sdk/js?client-id=ARrhiboHlMRN6APyBOA786x8ahN2Blr-3ixREgqaoBOd3nyQY_Iyx_CDedGcfEKoV6BcQ_6NOsrVVD2F&currency=USD"></script>
       
<script>
    
    paypal.Buttons({
        onClick(){

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var adress = $('#adress').val();

            if(name.length == 0)
            {   
                $('.name').text("Campul trebuie completat.");
            }
            else{
                $('.name').text("");
            }
            if(email.length == 0)
            {   
                $('.email').text("Campul trebuie completat.");
            }
            else{
                $('.email').text("");
            }
            if(phone.length == 0)
            {   
                $('.phone').text("Campul trebuie completat.");
            }
            else{
                $('.phone').text("");
            }
            if(pincode.length == 0)
            {   
                $('.pincode').text("Campul trebuie completat.");
            
            }
            else{
                $('.pincode').text("");
            }
            if(adress.length == 0)
            {   
                $('.adress').text("Campul trebuie completat.");
            
            }
            else{
                $('.adress').text("");
            }

            if(name.length == 0 || email.length == 0|| phone.length == 0 || pincode.length == 0 || adress.length == 0 )
            {
                return false;
            }

        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '36' 
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                const transaction = orderData.purchase_units[0].payments.captures[0];
                 
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var pincode = $('#pincode').val();
                var adress = $('#adress').val();

                var data = {
                    'name' :name,
                    'email' :email,
                    'phone':phone,
                    'pincode':pincode,
                    'adress':adress,
                    'payment_mode':"Paid by PayPal",
                    'payment_id':transaction.id,
                    'placeOrderBtn':true,
                }
                
                $.ajax({
                    method: "POST",
                    url: "functions/placeorder.php",
                    data: data,
                   
                    success: function (response) {
                        if(response==201){
                            alertify.succes("Comanda plasta cu succes!");
                            redirect("my-orders.php","");
                        }
                    }
                });
            });
        }
    }).render('#paypal-button-container');


</script>
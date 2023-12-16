<?php 

include('functions/userfunctions.php'); 
include('config/dbcon.php');

include('authenticate.php');

if(isset($_GET['t']) ){
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid( $tracking_no );
    if(mysqli_num_rows($orderData) < 0){
        ?>
        <h4>Ceva nu a functionat</h4>
        <?php
        die();
    }
}
else{
    ?>
        <h4>Ceva nu a functionat</h4>
    <?php
    die();
}

$data=mysqli_fetch_array($orderData);
?>


<!DOCTYPE html>
<html>
<head><!DOCTYPE html>
    <html lang="en">
    
    <head>
    <meta charset="UFT-8">
            <link rel="stylesheet" href="style.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ceramica</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
           
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                <script src="assets/js/jquery-3.7.1.min.js"></script>
               
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <a href="#"><img src="img/logo.png" height="75"></a>
        <div>
            <ul id="nvbar">
                <li><a class="active" href="index.php">Acasă</a></li>
                <li><a href="products.php">Categorii produse</a></li>
                <li><a href="about.php">Despre noi</a></li>
                <?php
                if(isset($_SESSION['auth'])){
                    ?>

                    <?= $_SESSION['auth_user']['name']; ?>
                    <li><a href="logout.php">Deconectează-te</a></li>

                    <?php
                }
                else{
                    ?>
                    <li><a  href="login.php"><i class="far fa-user"></i>Conectează-te</a></li> 
                    <?php
                }
                
                ?>

                 <li><a href="contact.php">Contact</a></li>
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
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>Detaliile comenzii</div>
                                    <a href="my-orders.php" class="btn btn-warning"><i class="fa fa-reply">Back</i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label><b>Nume</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['name'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Email</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['email'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Telefon</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['phone'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Trackin no</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['tracking_no'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Adresa</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['adress'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Cod postal</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['pincode'] ?>
                                                    </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label><b>Comentarii</b></label>
                                                    <div class="border p-1">
                                                        <?= $data['comments'] ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Produse</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Produs</th>
                                                    <th>Pret</th>
                                                    <th>Cantitate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $userId = $_SESSION['auth_user']['user_id'];

                                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,oi.qty as orderqty, p.selling_price as product_price, p.qty as product_qty, p.image as product_image, p.name as product_name
                                                                    FROM orders o
                                                                    INNER JOIN order_items oi ON oi.order_id = o.id
                                                                    INNER JOIN products p ON p.id = oi.prod_id
                                                                    WHERE o.user_id='$userId' AND o.tracking_no='$tracking_no'";
                                                    $order_query_run= mysqli_query($con,$order_query);
                                                    if(mysqli_num_rows($order_query_run) > 0){

                                                        foreach($order_query_run as $item){
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <img src="uploads/<?= $item['product_image'] ?>" width="50px" height="50px" alt="<?= $item['product_name']?>">
                                                                        <?= $item['product_name']?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['product_price']?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['orderqty']?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                
                                                
                                                ?>
                                            </tbody>
                                            </table>
                                            <hr>
                                            <h4>Pret total: <span class="float-end"><?= $data['total_price']  ?></span> </h4>
                                            <hr>
                                            <div class="">
                                                <label for=""><b>Metoda de plata: </b></label>
                                                <?= $data['payment_mode']?>
                                            </div>
                                            <div class="">
                                                <label for=""><b>Status: </b></label>
                                                <?php
                                                    if($data['status'] == 0)
                                                    {
                                                        echo "In curs de procesare.";
                                                    }
                                                    else if($data['status'] == 1){
                                                        echo "Comanda a fost trimisa firmei de curierat.";
                                                    }
                                                    else if($data['status'] == 2){
                                                        echo "Comanda anulata";
                                                    }
                                                    
                                                ?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="form">
                    <input type="text" placeholder="Scrie aici adresa ta de email">
                    <button class="normal">Inscrie-te</button>
                </div>
            </section>



        <!---footer---->
        <footer class="section-p1">
        <script src="assets/js/custom.js"></script>
             <!--Alertify Js JavaScript -->
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


            <div class="col">
                <img class="logo" src="img/logo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Adresa </strong> 2201 Hotel Cir S, San Diego, CA 92108</p>
                <p><strong>Phone: </strong> +01 2222 365</p>
                <p><strong>Hours: </strong>10:00 - 18:00, Luni - Vineri</p>
                <div class="follow">
                    <h4>Retele de socializare</h4>
                    <div class="icon">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-pinterest-p"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>
    
            <div class="col">
                <h4>Informatii utile</h4>
                <a href="#">Despre noi</a>
                <a href="#">Informatii despre transport</a>
                <a href="#">Politica de confidentialitate</a>
                <a href="#">Termeni si conditii</a>
                <a href="#">Contact</a>
            </div>
    
            <div class="col">
                <h4>Contul meu</h4>
                <a href="#">Conecteaza-te</a>
                <a href="#">Cosul de cumparaturi</a>
                <a href="#">Lista de dorinte</a>
                <a href="#">Urmareste comanda</a>
                <a href="#">Ajutor</a>
            </div>
        </footer>
    
    
        <script src="script.js"></script>
    
    </body>
    
    </html>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    
</body>
</html>
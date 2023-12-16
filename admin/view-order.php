<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');


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


<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>Detaliile comenzii</div>
                            <a href="orders.php" class="btn btn-warning"><i class="fa fa-reply">Back</i></a>
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
                                            $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* 
                                            FROM orders o
                                            INNER JOIN order_items oi ON oi.order_id = o.id
                                            INNER JOIN products p ON p.id = oi.prod_id
                                            WHERE o.tracking_no = '$tracking_no' order by o.id desc";
                                            $order_query_run= mysqli_query($con,$order_query);
                                            if(mysqli_num_rows($order_query_run) > 0){

                                                foreach($order_query_run as $item){
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <img src="../uploads/<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['name']?>">
                                                                <?= $item['name']?>
                                                            </td>
                                                            <td>
                                                                <?= $item['price']?>
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
                                    <div class="mb-3">
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="tracking_no" value="<?= $data['tracking_no']?>" >
                                            <label for=""><b>Status: </b></label>
                                            <select name="order_status" class="from-select">
                                                <option value="0"  <?= $data['status'] == 0?"selected":"" ?>  >In curs de procesare.</option>
                                                <option value="1"  <?= $data['status'] == 1?"selected":"" ?>  >Comanda a fost trimisa firmei de curierat.</option>
                                                <option value="2"  <?= $data['status'] == 2?"selected":"" ?> >Anulata.</option>
                                            </select>
                                            <button type="submit" name="update_order_btn" class="btn btn-primary mt-2 ms-5">Actualizeaza</button>
                                        </form>
                                        
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
 

<?php include('includes/footer.php');?>
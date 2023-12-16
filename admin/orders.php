<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Comenzi
                    <a href="order-history.php" class="btn btn-info float-end">Istoric comenzi</a>
                   </h4> 
                </div>
                <div class="card-body" >
                    <table class="table table-boardered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Client</th>
                                <th>Client</th>
                                <th>Tracking no</th>
                                <th>Pret</th>
                                <th>Data</th>
                                <th>Vizualizeaza</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getAllOrders();
                                if(mysqli_num_rows($orders) > 0){
                                    foreach($orders as $item){
                                        ?>
                                            <tr>
                                                <td> <?= $item['id']; ?></td>
                                                <td> <?= $item['user_id']; ?>
                                                <td> <?= $item['name']; ?>
                                                <td> <?= $item['tracking_no']; ?>
                                                <td> <?= $item['total_price']; ?>
                                                <td> <?= $item['created_at']; ?>
                                                <td>
                                                <a href="view-order.php?t=<?=$item['tracking_no']?>" class="btn btn-primary">Detalii</a>
                                                </td>
                                            </tr>
                                        <?php

                                    }
                                }
                                else{
                                    echo "Nicio inregistrare gasita";
                                }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Produse</h4> 
                </div>
                <div class="card-body" id="products_table">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <table class="table table-boardered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nume</th>
                                    <th>Imagine</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $products = getAll("products");
                                    if(mysqli_num_rows($products) > 0){
                                        foreach($products as $item){
                                            ?>
                                                <tr>
                                                    <td> <?= $item['id']; ?> </td>
                                                    <td> <?= $item['name']; ?> </td>
                                                    <td> 
                                                        <img src="../uploads/<?=$item['image']?>" width="50px" height="50px" alt="<?= $item['name']; ?>"> 
                                                    </td>
                                                    <td>
                                                        <?= $item['status'] == '1'? "Visible":"Hidden" ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-danger delete_product_btn" value="<?= $item['id']; ?>" >Sterge</button>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
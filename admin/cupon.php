<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Cupoane de reducer</h4> 
                </div>
                <div class="card-body" id="cupoane_table">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <table class="table table-boardered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cod cupon</th>
                                    <th>Valoare cupon </th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $cupoane = getAll("cupoane");
                                    if(mysqli_num_rows($cupoane) > 0){
                                        foreach($cupoane as $item){
                                            ?>
                                                <tr>
                                                    <td> <?= $item['id']; ?> </td>
                                                    <td> <?= $item['cupon']; ?> </td>
                                                    <td>
                                                        <?= $item['valoare']?>
                                                    </td>
                                                    <td>
                                                        <?=  $item['status'] == '1'? "Visible":"Hidden"; ?> </td>
                                                    <td>
                                                        <a href="edit-cupon.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-danger delete_cupon_btn" value="<?= $item['id']; ?>" >Sterge</button>
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
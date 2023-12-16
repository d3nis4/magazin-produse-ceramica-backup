<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Categorii produse</h4> 
                </div>
                <div class="card-body" id="category_table">
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
                                $category = getAll("categories");
                                if(mysqli_num_rows($category) > 0){
                                    foreach($category as $item){
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
                                                    <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['id']; ?>">Sterge</button>
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
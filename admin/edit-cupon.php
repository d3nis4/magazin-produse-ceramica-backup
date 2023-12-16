<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];  
                    $cupon = getById("cupoane", $id);

                    if(mysqli_num_rows($cupon) > 0)
                    {
                        $data=mysqli_fetch_array($cupon);
                        ?>
                            <div class="card">
    <div class="card-header">
        <h4>Editează cupon
            <a href="cupon.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="cupon_id" value="<?= $data['id']; ?> ">
                    <label class="mb-0">Cod reducere</label>
                    <input type="text" required name="nume_cupon" value="<?= $data['cupon']; ?>" placeholder="Introdu numele cuponului" class="form-control mb-2">
                </div>
                <div class="col-md-3">
                    <label class="mb-0">Status</label> <br>
                    <input type="checkbox" name="status" <?= $data['status'] == '1' ? 'checked' : '' ?>>
                </div>
                
            </div>
            <div class="col-md-3">
                    <label class="mb-0">Valoare cupon</label>
                    <input type="text" required name="valoare_cupon" value="<?= $data['valoare']; ?>" placeholder="Introdu valoarea cuponului" class="form-control mb-2">
                </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="update_cupon_btn">Actualizează</button>
                </div>
            </div>
        </form>
    </div>
</div>

                        <?php
                    }
                    else{
                        echo "Produsul nu a fost găsit pentru id-ul dat.";
                    }
                  
                }  
                else{
                    echo "Id-ul lipsește din url";
                }
                ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
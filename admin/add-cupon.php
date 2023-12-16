<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adaugă cupoane de reducere
                    <a href="cupon.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
    <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label class="mb-0">Denumire cupon</label>
                        <input type="text" required name="name_cupon" placeholder="Introdu numele cuponului" class="form-control mb-2">
                    </div>
                    <div class="col-md-3">
                        <label class="mb-0">Status</label> <br>
                        <input type="checkbox" name="status_cupon">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="mb-0">Valoare</label>
                        <input type="text" required name="val_cupon" placeholder="Introdu valoarea cuponului" class="form-control mb-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="add_cupon_btn">Salveaza</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
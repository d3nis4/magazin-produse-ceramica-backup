<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adaugă produs
                    <a href="category.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Alege categorie</label>
                                <select required name="category_id" class="form-select mb-2">
                                    <option selected>Alege o categorie</option>
                                    <?php 
                                        $categories = getAll("categories");

                                        if(mysqli_num_rows($categories) > 0) {
                                            foreach($categories as $item){
                                                ?>
                                                    <option value="<?= $item['id']; ?>"> <?= $item['name']; ?> </option>
                                                <?php
                                            }
                                        }
                                        else{
                                           echo "Nicio categorie disponibilă";
                                        }
                                    ?>                                 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Name</label>
                                <input type="text" required name="name" placeholder="Introdu numele categoriei" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" required name="slug" placeholder="Introdu slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Descriere scurtă</label>
                                <textarea rows="3" required name="small_description" placeholder="Introdu o descriere scurtă" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Descriere</label>
                                <textarea rows="3" required name="description" placeholder="Introdu o descriere" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Pret original</label>
                                <input type="text" required name="original_price" placeholder="Introdu pretul original" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Pret de vanzare</label>
                                <input type="text" required name="selling_price" placeholder="Introdu pretul de vanzare" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Incarca o imagine</label>
                                <input type="file" required name="image" class="form-control mb-2">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0">Canitatea</label>
                                    <input type="number" required name="qty" placeholder="Introdu cantitatea" class="form-control mb-2">
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Status</label> <br>
                                    <input type="checkbox" name="status" >
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Trending</label> <br>
                                    <input type="checkbox" name="trending" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Title</label>
                                <input type="text" required name="meta_title" placeholder="Introdu un titlu meta" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Descriere</label>
                                <textarea rows="3" required name="meta_description" placeholder="Introdu o meta descriere" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta keywords</label>
                                <textarea rows="3" required name="meta_keywords" placeholder="Introdu meta cuvinte cheie" class="form-control mb-2"></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"  name="add_product_btn">Salveaza</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
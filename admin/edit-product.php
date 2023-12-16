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
                    $product = getById("products", $id);

                    if(mysqli_num_rows($product) > 0)
                    {
                        $data=mysqli_fetch_array($product);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Editează produs
                                    <a href="products.php" class="btn btn-primary float-end">Back</a>
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
                                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id']? 'selected':'' ?> > <?= $item['name']; ?> </option>
                                                                <?php
                                                            }
                                                        }
                                                        else{
                                                        echo "Nicio categorie disponibilă";
                                                        }
                                                    ?>                                 
                                                </select>
                                            </div>
                                            <input type="hidden" name="product_id" value="<?= $data['id']; ?> ">
                                            <div class="col-md-6">
                                                <label class="mb-0">Name</label>
                                                <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="Introdu numele categoriei" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Slug</label>
                                                <input type="text" required name="slug" value="<?= $data['slug']; ?>" placeholder="Introdu slug" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Descriere scurtă</label>
                                                <textarea rows="3" required name="small_description" placeholder="Introdu o descriere scurtă" class="form-control mb-2"><?= $data['small_description']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Descriere</label>
                                                <textarea rows="3" required name="description" placeholder="Introdu o descriere" class="form-control mb-2"><?= $data['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Pret original</label>
                                                <input type="text" required name="original_price" value="<?= $data['original_price']; ?>" placeholder="Introdu pretul original" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0">Pret de vanzare</label>
                                                <input type="text" required name="selling_price" value="<?= $data['selling_price']; ?>" placeholder="Introdu pretul de vanzare" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Încarcă o imagine</label>
                                                
                                                <input type="file"  name="image" class="form-control mb-2">
                                                <label class="mb-0">Imagine curentă</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                                <img src="../uploads/<?= $data['image']; ?>" alt="Product Image" height="50px" width="50px">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-0">Canitatea</label>
                                                    <input type="number"  required name="qty" value="<?= $data['qty']; ?>" placeholder="Introdu cantitatea" class="form-control mb-2">
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-0">Status</label> <br>
                                                    <input type="checkbox" name="status" <?=$data['status'] == '1'?'checked':'' ?>  >
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-0">Trending</label> <br>
                                                    <input type="checkbox" name="trending" <?=$data['trending'] == '1'?'checked':'' ?> >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Meta Title</label>
                                                <input type="text" required name="meta_title" value="<?= $data['meta_title']; ?>" placeholder="Introdu un titlu meta" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Meta Descriere</label>
                                                <textarea rows="3" required name="meta_description" placeholder="Introdu o meta descriere" class="form-control mb-2"><?= $data['meta_description']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Meta keywords</label>
                                                <textarea rows="3" required name="meta_keywords" placeholder="Introdu meta cuvinte cheie" class="form-control mb-2"><?= $data['meta_keywords']; ?></textarea>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary"  name="update_product_btn">Actualizează</button>
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
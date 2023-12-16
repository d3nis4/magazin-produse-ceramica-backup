<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $category = getById("categories",$id);

                    if(mysqli_num_rows($category) > 0){
                        $data = mysqli_fetch_array($category);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Editeaza categorie
                                        <a href="category.php" class="btn btn-primary float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>" >
                                                <label for="">Denumire</label>
                                                <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Introdu numele categoriei" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Slug</label>
                                                <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Introdu slug" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Descriere</label>
                                                <textarea rows="3" name="description" placeholder="Introdu o descriere" class="form-control"><?= $data['description'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Incarca o imagine</label>
                                                <input type="file" name="image" class="form-control">
                                                <label for="">Imaginea curenta</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                                <img src="../uploads/<?= $data['image'] ?>" height="50px" width="50px" alt="">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta Title</label>
                                                <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Introdu un titlu meta" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta Descriere</label>
                                                <textarea rows="3" name="meta_description" placeholder="Introdu o meta descriere" class="form-control"><?= $data['meta_description'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta keywords</label>
                                                <textarea rows="3" name="meta_keywords" placeholder="Introdu meta cuvinte cheie" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Status</label>
                                                <input type="checkbox" <?= $data['status'] ? "checked":"" ?> name="status" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Popular</label>
                                                <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular" >
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_category_btn">Actualizează</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                    else{
                        echo "Categoria nu este gasita";
                    }
                }
                else{
                    echo "Id lipseste din url";
                }
            
            ?>
            
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
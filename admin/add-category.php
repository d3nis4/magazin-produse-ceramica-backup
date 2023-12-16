<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adauga categorie
                    <a href="category.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Introdu numele categoriei" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" placeholder="Introdu slug" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Descriere</label>
                                <textarea rows="3" name="description" placeholder="Introdu o descriere" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Incarca o imagine</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Introdu un titlu meta" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Descriere</label>
                                <textarea rows="3" name="meta_description" placeholder="Introdu o meta descriere" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Introdu meta cuvinte cheie" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" >
                            </div>
                            <div class="col-md-6">
                                <label for="">Popular</label>
                                <input type="checkbox" name="popular" >
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Salveaza</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
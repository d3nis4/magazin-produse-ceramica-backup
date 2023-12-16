$(document).ready(function () {

    $(document).on('click','.delete_product_btn', function (e) {
        e.preventDefault();

        var id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'product_id': id,
                        'delete_product_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Produs șters cu succes!", "success");
                            $("#products_table").load(location.href + " #products_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });

            }
        });
    });

    $(document).on('click', '.delete_cupon_btn', function (e) {
        e.preventDefault();
    
        var cuponId = $(this).val();
    
        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'cupon_id': cuponId,
                        'delete_cupon_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Cupon șters cu succes!", "success");
                            $("#cupoane_table").load(location.href + " #cupoane_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });
            }
        });
    });
    




    $(document).on('click','.delete_category_btn', function (e) {
        
        e.preventDefault();

        var id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'category_id': id,
                        'delete_category_btn': true
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Categorie ștearsă cu succes!", "success");
                            $("#category_table").load(location.href + " #category_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });

            }
        });
    });

});

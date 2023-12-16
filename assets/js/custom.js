function updateTotalPrice() {
    var totalPrice = 0;
    $('.product_data').each(function() {
        var sellingPriceText = $(this).find('.selling-price h5').text().replace(' lei', '');
        var sellingPrice = parseFloat(sellingPriceText);
        var quantity = parseInt($(this).find('.input-qty').val(), 10);

        console.log('Selling Price Text:', sellingPriceText);
        console.log('Selling Price:', sellingPrice);
        console.log('Quantity:', quantity);

        totalPrice += sellingPrice * quantity;
    });

    $('#totalPriceValue').text(totalPrice);
}





$(document).ready(function () {


    $('#applyCouponBtn').on('click', function(){
        var cupon = $('#cupon').val();
        var totalPrice = parseFloat($('#hiddenTotalPrice').val()); 
        console.log(typeof totalPrice); 
        $.ajax({
            method: 'POST',
            url: 'functions/cuponfct.php',
            data: {
                cupon: cupon,
                totalPrice: totalPrice // Trimiterea variabilei totalPrice
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alertify.error(response.error);
                    return;
                }
            
              
    
                var newTotalPrice = response.newTotalPrice;
                $('#newTotalPrice').text('Cos nou: ' + newTotalPrice).show();
    
                var transportCost = (newTotalPrice >= 150) ? 'Gratuit!' : '19 lei';
                $('#transportCost').text('Transport: ' + transportCost);
                
                var totalCost = newTotalPrice + ((newTotalPrice >= 150) ? 0 : 19);
                $('#totalCost').text(totalCost);
    


                alertify.success("Cuponul a fost aplicat cu succes!");


            },
            error: function(xhr, status, error) {
                console.error(error);
                alertify.error("A apărut o eroare în aplicarea cuponului.");
            }
        });
    });




     
    $(document).off('click', '.increment-btn').on('click', '.increment-btn', function(e) {
        e.preventDefault();
    
       
        var inputQty = $(this).closest('.card').find('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($(this).closest('.card').find('.databaseQty').val(), 10);
        console.log('Value:', value);
        console.log('Qty din baza de date:', qtyDinBazaDeDate);

        if (!isNaN(value) && value < qtyDinBazaDeDate) {
            inputQty.val(value + 1);
        } else {
            console.log('Value is already equal or greater than Qty from Database');
        }
       

    });
    
    $(document).off('click', '.decrement-btn').on('click', '.decrement-btn', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).closest('.card').find('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($(this).closest('.card').find('.databaseQty').val(), 10);
    
        if (!isNaN(value) && value > 1) {
            inputQty.val(value - 1);
        }
    });

    $(document).off('click', '.increment-btn-prod').on('click', '.increment-btn-prod', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).siblings('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($('.databaseQty').val(), 10);
    
        if (!isNaN(value) && value < qtyDinBazaDeDate) {
            inputQty.val(value + 1);
        } else {
            console.log('Value is already equal or greater than Qty from Database');
        }
    });
    
    $(document).off('click', '.decrement-btn-prod').on('click', '.decrement-btn-prod', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).siblings('.input-qty');
        var value = parseInt(inputQty.val(), 10);
    
        if (!isNaN(value) && value > 1) {
            inputQty.val(value - 1);
        }
    });


    $('.addToCartBtn').click(function (e) { 
        e.preventDefault();

        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id= $(this).val();
        
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                
                if(response==201){
                   
                    alertify.success("Produs adaugat cu succes!");
                }
                else if(response=="exist"){
                    alertify.success("Produsul se afla deja in cosul de cumparaturi!");
                }
                else if(response==401){
                    alertify.success("Conecteaza-te pentru a continua");
                }
                else if(response==500){
                    alertify.success("Ceva nu a functionat");
                }
            }
        });
    });


    $('.addToCartProduct').click(function (e) { 
        e.preventDefault();
    
        var prod_id = $(this).closest('.pro').find('.prod_id').val();
        console.log("Produs ID:", prod_id);
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": 1, 
                "scope": "add"
            },
            success: function (response) {
                
                if(response == 201){
                    alertify.success("Produs adăugat cu succes!");
                }
                else if(response == "exist"){
                    alertify.success("Produsul se află deja în coșul de cumpărături!");
                }
                else if(response == 401){
                    alertify.success("Conectează-te pentru a continua");
                }
                else if(response == 500){
                    alertify.success("Ceva nu a funcționat");
                }
            }
        });
    });
    


     $(document).on('click','.updateQty', function () {

        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id= $(this).closest('.product_data').find('.prod-id').val();
       
        console.log("Product ID:", prod_id, "Quantity:", qty);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                console.log('Răspuns:', response);
                if(response==200){
                    alertify.success("Produs actualizat cu succes!");
                }
                else if(response==500){
                    alertify.success("Ceva nu a functionat");
                }
            }
        });
    });


   

    
    $(document).on('click','.deleteItem', function () {

        var cart_id = $(this).val();
        
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200){
                    alertify.success("Produs sters cu succes!");
                    $('#mycart').load(' #mycart > *');

                }
                else{
                    alertify.success(response);
                }
            }
        });
        
    }); 
    
    
    
 
    $(document).on('click', '.updateQty, .deleteItem', function() {
        updateTotalPrice();
    });




});



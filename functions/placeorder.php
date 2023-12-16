<?php
session_start();
include('../config/dbcon.php');



if(isset($_SESSION['auth'])){

    if(isset($_POST['palceOrderBtn'])){

        
        $name= mysqli_real_escape_string($con,$_POST['name']);
        $email= mysqli_real_escape_string($con,$_POST['email']);
        $phone= mysqli_real_escape_string($con,$_POST['phone']);
        $pincode= mysqli_real_escape_string($con,$_POST['pincode']);
        $adress= mysqli_real_escape_string($con,$_POST['adress']);
        $payment_mode=mysqli_real_escape_string($con,$_POST['payment_mode']);
        
        if($payment_mode=="card"){
            $_SESSION['message'] = "Trebuie prima data sa platesti pentru a putea plasa comanda!";
            header('Location: ../checkout.php');
            exit(0);
        }


        if($name=="" || $email=="" || $phone=="" || $pincode=="" || $adress=="")
        {
            $_SESSION['message'] = "Toate campurile trebuie completate!";
            header('Location: ../checkout.php');
            exit(0);
        }


        $userId = $_SESSION['auth_user']['user_id'];
        $query= "SELECT c.id as cid ,c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                from carts c, products p where c.prod_id=p.id and c.user_id='$userId' order by c.id desc ";
        $query_run = mysqli_query($con,$query);

    
        $totalPrice = 0;
        foreach($query_run as $citem)
        {
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        }

        $tracking_no = "".rand(111,999).substr($phone,2);

        $insert_query = "INSERT into orders (tracking_no, user_id, name, email, phone, adress, pincode, 
        total_price, payment_mode, payment_id) values ('$tracking_no','$userId','$name','$email',
        '$phone','$adress','$pincode','$totalPrice','$payment_mode','$payment_id')";

        $insesrt_query_run=mysqli_query($con,$insert_query);
        if( $insesrt_query_run){

            $order_id= mysqli_insert_id($con);
            foreach($query_run as $citem)
            {   
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['selling_price'];
                
                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price')";
                $insert_items_query_run = mysqli_query($con, $insert_items_query);
               
                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
                $product_query_run = mysqli_query($con, $product_query);
                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);

            
            }

            $deleteCartQuery = "DELETE from carts where user_id='$userId' ";
            $deleteCartQuery_run = mysqli_query($con,$deleteCartQuery);


            if( $payment_mode == "cash"){
                $_SESSION['message']="Comanda a fost plasata cu succes!";
                header('Location: ../my-orders.php');
                die();
            }
            else{
                echo 201;
            }
        }


    }

}
else{
    header('Location: ../index.php');
}


?>
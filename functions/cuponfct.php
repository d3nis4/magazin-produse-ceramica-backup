<?php
include('../config/dbcon.php');

if (isset($_POST['cupon']) && isset($_POST['totalPrice'])) {
    $cupon = $_POST['cupon'];
 
    $cupon_query = "SELECT * FROM cupoane WHERE cupon = '$cupon'";
    $cupon_result = mysqli_query($con, $cupon_query);

    $totalPrice = floatval($_POST['totalPrice']);

    if ($cupon_result) {
        $cupon_data = mysqli_fetch_assoc($cupon_result);

        if ($cupon_data) {
            $cupon_valoare = floatval($cupon_data['valoare']); 

            if (is_numeric($totalPrice) && is_numeric($cupon_valoare)) {
                $reducere = $totalPrice * ($cupon_valoare / 100);
                $totalPrice -= $reducere;

                echo json_encode(['newTotalPrice' => $totalPrice]);
            } else {
                echo json_encode(['error' => 'Couponul nu a putut fii aplicat.']); 
            }
        } else {
            echo json_encode(['error' => "Cuponul nu există!"]);
        }
    } else {
        echo json_encode(['error' => "Eroare la interogare!"]);
    }
}
?>

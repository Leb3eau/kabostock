<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $productId = $_POST['productId'];

    $productName = $_POST['productName'];
    $paymentType = $_POST['paymentType'];
    $paymentMode = $_POST['paymentMode'];
    $quantity = $_POST['quantity'];
    $ratea = $_POST['ratea'];
    $brandName = $_POST['brandName'];
    $date_livraison = $_POST['datelivraison'];

    $productStatus = $_POST['editProductStatus'];


    $sql = "UPDATE product SET produit_id = '$productName', payment_type = '$paymentType', payment_mode = '$paymentMode', date_livraison = '$date_livraison', four_id = '$brandName', quantity = '$quantity', ratea = '$ratea', qte_initial='$quantity', active = '$productStatus', status = 1 WHERE product_id = $productId ";

    if ($connect->query($sql) === TRUE) {

        $mo = $quantity * $ratea;
        $sqlp = "UPDATE four_pay SET four_id='$brandName', date='$date_livraison', qte='$quantity', montant_total='$mo' WHERE prod_id='$productId'";
        $connect->query($sqlp);

        $valid['success'] = true;
        $valid['messages'] = "Modification effectuée avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec de modification";
    }
} // /$_POST

$connect->close();

echo json_encode($valid);


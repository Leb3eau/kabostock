<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $orderId = $_POST['orderId'];
    $payAmount = $_POST['payAmount'];
    $paymentType = $_POST['paymentType'];
    $paymentStatus = $_POST['paymentStatus'];
    $paidAmount = $_POST['paidAmount'];
    $grandTotal = $_POST['grandTotal'];
    $paymentDate = $_POST['paymentDate'];

    $updatePaidAmount = $payAmount + $paidAmount;
    $updateDue = $grandTotal - $updatePaidAmount;

    $sql = "INSERT INTO order_payment VALUES (NULL,'$orderId', '$payAmount', '$paymentDate')";
    $connect->query($sql);
    
    $sql = "UPDATE orders SET paid = '$updatePaidAmount', due = '$updateDue', payment_type = '$paymentType', payment_status = '$paymentStatus' WHERE order_id = {$orderId}";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Modification effectuée avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec de Modification !";
    }


    $connect->close();

    echo json_encode($valid);
} // /if $_POST
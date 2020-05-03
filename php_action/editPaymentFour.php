<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $orderId = $_POST['orderId'];
    $payAmount = $_POST['payAmount'];
    $paymentDate = $_POST['paymentDate'];

    
    $sql = "UPDATE four_pay SET total_paiement =total_paiement+ '$payAmount', reste_paiement = reste_paiement-'$payAmount', date = '$paymentDate' WHERE id = {$orderId}";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Paiement effectué avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec de Paiement !";
    }


    $connect->close();

    echo json_encode($valid);
} // /if $_POST
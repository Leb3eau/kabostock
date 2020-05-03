<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if ($_POST) {

    $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));
    $clientName = $_POST['clientName'];
    $clientContact = $_POST['clientContact'];
    $subTotalValue = $_POST['subTotalValue'];
    $vatValue = $_POST['vatValue'];
    $totalAmountValue = $_POST['totalAmountValue'];
    	
    $sql = "INSERT INTO devis VALUES (NULL, '$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', 1)";

    $devis_id;
    $orderStatus = false;
    if ($connect->query($sql) === true) {
        $devis_id = $connect->insert_id;
        $valid['devis_id'] = $devis_id;
        $orderStatus = true;
    }

    // echo $_POST['productName'];
    $orderItemStatus = false;

     for ($x = 0; $x < count($_POST['productName']); $x++) {
           
            // add into devis_item
            $orderItemSql = "INSERT INTO devis_item VALUES (NULL, '$devis_id', '" . $_POST['productName'][$x] . "', '" . $_POST['quantity'][$x] . "', '" . $_POST['rateaValue'][$x] . "', '" . $_POST['ratev'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";

            $connect->query($orderItemSql);

            if ($x == count($_POST['productName'])) {
                $orderItemStatus = true;
            }        
    }

    $valid['success'] = true;
    $valid['messages'] = "Ajout Effectué avec succès !";

    $connect->close();

    echo json_encode($valid);
}
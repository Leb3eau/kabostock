<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $orderId = $_POST['orderId'];

    $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));
    $clientName = $_POST['clientName'];
    $clientContact = $_POST['clientContact'];
    $subTotalValue = $_POST['subTotalValue'];
    $vatValue = $_POST['vatValue'];
    $totalAmountValue = $_POST['totalAmountValue'];
	
    $sql = "UPDATE devis SET devis_date = '$orderDate', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', devis_status = 1 WHERE devis_id = {$orderId}";
    $connect->query($sql);

    // remove the order item data from order item table
    for ($x = 0; $x < count($_POST['productName']); $x++) {
        $removeOrderSql = "DELETE FROM devis_item WHERE devis_id = {$orderId}";
        $connect->query($removeOrderSql);
    } // /for quantity


        // insert the order item data 
        for ($x = 0; $x < count($_POST['productName']); $x++) {
           
            // add into devis_item
            $orderItemSql = "INSERT INTO devis_item VALUES (NULL, '$orderId', '" . $_POST['productName'][$x] . "', '" . $_POST['quantity'][$x] . "', '" . $_POST['rateaValue'][$x] . "', '" . $_POST['ratev'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";

            $connect->query($orderItemSql);

            if ($x == count($_POST['productName'])) {
                $orderItemStatus = true;
            }        
    }
    



    $valid['success'] = true;
    $valid['messages'] = "Modification Effectuée avec succès !";

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
// echo json_encode($valid);
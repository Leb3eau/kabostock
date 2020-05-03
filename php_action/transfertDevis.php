<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if ($_POST) {

    $orderDate = date('Y-m-d');

    $id = $_POST['orderId'];

    $sql = "SELECT * FROM devis WHERE devis.devis_id = {$id}";
    $result = $connect->query($sql);
    $data = $result->fetch_row();

    $clientName = $data[2];
    $clientContact = $data[3];
    $subTotalValue = $data[4];
    $vatValue = $data[5];
    $totalAmountValue = $data[6];

    $discount = $_POST['remise'];
    $grandTotalValue = $_POST['grandTotal'];
    $paid = $_POST['paid'];
    $dueValue = $_POST['due'];
    $paymentType = $_POST['type_paiement'];
    $paymentStatus = $_POST['mode_paiement'];

    $sql = "INSERT INTO orders VALUES (NULL, '$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";

    $order_id;
    $orderStatus = false;
    if ($connect->query($sql) === true) {
        $order_id = $connect->insert_id;
        $valid['order_id'] = $order_id;
        $orderStatus = true;
    }

    
    $orderItemSql = "SELECT * FROM devis_item WHERE devis_item.devis_id = {$id}";
    $item = $connect->query($orderItemSql);
    while ($itemData = $item->fetch_array()) {

        $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = " . $itemData['product_id'] . "";
        $updateProductQuantityData = $connect->query($updateProductQuantitySql);

        while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            $updateQuantity = $updateProductQuantityResult[0] - $itemData['quantity'];
            // update product table

            if ($updateQuantity >= 0) {
                
                if ($updateQuantity == 0) {
                    $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity . "', active=2 WHERE product_id = " . $itemData['product_id'] . "";
                } else {
                    $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity . "' WHERE product_id = " . $itemData['product_id'] . "";
                }
                $connect->query($updateProductTable);

                // add into order_item
                $orderItemSql = "INSERT INTO order_item VALUES (NULL, '$order_id', '" . $itemData['product_id'] . "', '" . $itemData['quantity'] . "', '" . $itemData['ratea'] . "', '" . $itemData['ratev'] . "', '" . $itemData['total'] . "', 1)";

                $connect->query($orderItemSql);

                
            } else {
                $valid['success'] = FALSE;
                $valid['messages'] = "La quantité restante de cet article est insuffisante!";
            }
        } // while	
    } // /while quantity
    
        $updateDevisTable = "UPDATE devis SET devis_status = 2 WHERE devis_id = " . $id . "";
        $connect->query($updateDevisTable);

        $valid['success'] = TRUE;
        $valid['messages'] = "Transfert Effectué avec succès !";
    
    $connect->close();

    echo json_encode($valid);
}
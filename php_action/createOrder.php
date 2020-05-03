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
    $discount = $_POST['discount'];
    $grandTotalValue = $_POST['grandTotalValue'];
    $paid = $_POST['paid'];
    $dueValue = $_POST['dueValue'];
    $paymentType = $_POST['paymentType'];
    $paymentStatus = $_POST['paymentStatus'];



    if (!empty($_FILES['cheque']['name'])) {
        $nom_fichier = "Cheque_" . date('d-m-Y_His') . ".";

        $status = 1;

        $sql = "SELECT * FROM g_clients WHERE nom_prenom = '$clientName'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $verifNomClt = $row[0];
            }
        } else {
            $verifNomClt = FALSE;
        }

        if ($verifNomClt) {
            $idclt = $verifNomClt;
        } else {
            $sql = "INSERT INTO g_clients VALUES (NULL,'$clientName', '$status')";
            $connect->query($sql);
            $idclt = $connect->insert_id;
        }

        if ($idclt) {

            $fichiers = $_FILES['cheque'];
            $url = '../assests/pj/' . $fichiers['name'];
            $nom_fichier .= pathinfo($fichiers['name'], PATHINFO_EXTENSION);
            if (move_uploaded_file($fichiers['tmp_name'], $url)) {
                $sql = "INSERT INTO g_fichiers VALUES (NULL,'$idclt','$nom_fichier', '$url', '$status')";
                $connect->query($sql);
            }
        }
    }


    $sql = "INSERT INTO orders VALUES (NULL, '$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";

    $order_id;
    $orderStatus = false;
    if ($connect->query($sql) === true) {
        $order_id = $connect->insert_id;
        $valid['order_id'] = $order_id;
        $orderStatus = true;
    }



    if ($paymentStatus == 2 || $paymentStatus == 3) {

        $sql = "INSERT INTO order_payment VALUES (NULL,'$order_id', '$paid', '$orderDate')";
        $connect->query($sql);
    }



    // echo $_POST['productName'];
    $orderItemStatus = false;

    for ($x = 0; $x < count($_POST['productName']); $x++) {
        $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = " . $_POST['productName'][$x] . "";
        $updateProductQuantityData = $connect->query($updateProductQuantitySql);

        while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            $updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];
            // update product table
            if ($updateQuantity[$x] == 0) {
                $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity[$x] . "', active=2 WHERE product_id = " . $_POST['productName'][$x] . "";
            } else {
                $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity[$x] . "' WHERE product_id = " . $_POST['productName'][$x] . "";
            }
            $connect->query($updateProductTable);

            // add into order_item
            $orderItemSql = "INSERT INTO order_item VALUES (NULL, '$order_id', '" . $_POST['productName'][$x] . "', '" . $_POST['quantity'][$x] . "', '" . $_POST['rateaValue'][$x] . "', '" . $_POST['ratev'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";

            $connect->query($orderItemSql);

            if ($x == count($_POST['productName'])) {
                $orderItemStatus = true;
            }
        } // while	
    } // /for quantity

    $valid['success'] = true;
    $valid['messages'] = "Ajout Effectué avec succès !";

    $connect->close();

    echo json_encode($valid);
}    
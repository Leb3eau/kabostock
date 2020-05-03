<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $productName = $_POST['productName'];
    $marque = $_POST['marque'];
    $type = $_POST['type'];
    $desc = $_POST['desciption'];

    $sql = "INSERT INTO produits VALUES (NULL, '$productName', '$marque', '$type', '$desc')";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Ajout Effectué avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec d'ajout !";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
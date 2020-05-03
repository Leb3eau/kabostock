<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $lib = $_POST['libCharge'];
    $date = $_POST['dateCharge'];
    $montant = $_POST['montantCharge'];
    $ref = $_POST['refCharge'];
    
    $sql = "INSERT INTO charges VALUES(NULL, '$lib', '$date','$montant','$type', '$ref')";

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
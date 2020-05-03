<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $lib = $_POST['libDepenses'];
    $date = $_POST['dateDepenses'];
    $montant = $_POST['montantDepenses'];
    $type = $_POST['typeDepenses'];
    
    if($type == "Autre")
        $type = $_POST['AutretypeDepenses'];
    
    $sql = "INSERT INTO depenses VALUES(NULL, '$date', '$lib', '$montant', '$type')";

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
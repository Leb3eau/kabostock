<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $clt = $_POST['clt'];
    $desc = $_POST['desc'];
    $daterdv = $_POST['daterdv'];
    $cnt = $_POST['contact'];
    $lieu = $_POST['lieu'];
    $heure = $_POST['heure'];
    $status = 1;
    $etat = "En cours";

    $sql = "INSERT INTO rdv VALUES (NULL,'$clt','$cnt', '$desc', '$lieu', '$daterdv', '$heure', '$etat', '$status')";

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
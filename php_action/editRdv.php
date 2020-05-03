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
    
    $perso = $_POST['id'];

    $sql = "UPDATE rdv SET client = '$clt',lieu='$lieu', description = '$desc', date='$daterdv', heure='$heure', contact='$cnt' WHERE id = '$perso'";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Modification Effectuée avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec de modification !";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
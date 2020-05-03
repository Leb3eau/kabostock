<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $orderId = $_POST['orderId'];
    $h = $_POST['nh'];
    $d = $_POST['nd'];
    
    $sql = "UPDATE rdv SET date = '$d', heure = '$h' WHERE id = {$orderId}";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Rendez-vous reporté avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec !";
    }


    $connect->close();

    echo json_encode($valid);
} // /if $_POST
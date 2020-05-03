<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $lib = $_POST['editLibDepenses'];
    $date = $_POST['editDateDepenses'];
    $montant = $_POST['editMontantDepenses'];
    $type = $_POST['edittypeDepenses'];
    $categoriesId = $_POST['editCategoriesId'];
    if($type == "Autre")
        $type = $_POST['editAutretypeDepenses'];

    $sql = "UPDATE depenses SET libelle = '$lib', type = '$type', date = '$date', montant='$montant' WHERE id = '$categoriesId'";

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
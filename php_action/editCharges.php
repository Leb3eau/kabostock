<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $lib = $_POST['editlibCharge'];
    $date = $_POST['editdateCharge'];
    $montant = $_POST['editmontantCharge'];
    $categoriesId = $_POST['editCategoriesId'];
    $ref = $_POST['editrefCharge'];

    $sql = "UPDATE charges SET libelle_charge = '$lib', date_charge = '$date', montant_charge='$montant', type='$type', reference='$ref' WHERE charges_id = '$categoriesId'";

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
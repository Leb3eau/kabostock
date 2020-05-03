<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $productName = $_POST['productName'];
    $marque = $_POST['marque'];
    $type = $_POST['type'];
    $desc = $_POST['desciption'];
    $categoriesId = $_POST['editCategoriesId'];

    $sql = "UPDATE produits SET designation = '$productName', marque = '$marque', type='$type', description='$desc' WHERE id = '$categoriesId'";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Modification Effectuée avec succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec de modification !";
    }

    $connect->close();

    echo json_encode($valid);
}
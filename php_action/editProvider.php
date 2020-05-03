<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $brandName = $_POST['editBrandName'];
    $brandStatus = $_POST['editBrandStatus'];
    $brandCont = $_POST['editContact'];
    $brandId = $_POST['brandId'];
    $brandRCCM=$_POST['RCCM'];
    $brandCC=$_POST['CC'];
    $brandSiege_social=$_POST['Siege_social'];
    $brandEmail=$_POST['Email'];
    $brandNom_Livreur=$_POST['Nom_Livreur'];
    $brandNumero_Livreur=$_POST['Numero_Livreur'];
    $brandAdresse_Postale=$_POST['Adresse_Postale'];

    $sql = "UPDATE fournisseurs SET four_name = '$brandName', four_contact = '$brandCont', four_active = '$brandStatus', RCCM='$brandRCCM',CC='$brandCC',Siege_social='$brandSiege_social',Email='$brandEmail',Nom_Livreur='$brandNom_Livreur',Numero_Livreur='$brandNumero_Livreur',Adresse_Postale='$brandAdresse_Postale' WHERE four_id = '$brandId'";

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
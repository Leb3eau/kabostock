<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $brandName = $_POST['brandName'];
    $brandStatus = $_POST['brandStatus'];
    $brandCont = $_POST['contactFourn'];
    $brandRCCM=$_POST['RCCM'];
    $brandCC=$_POST['CC'];
    $brandSiege_social=$_POST['Siege_social'];
    $brandEmail=$_POST['Email'];
    $brandNom_Livreur=$_POST['Nom_Livreur'];
    $brandNumero_Livreur=$_POST['Numero_Livreur'];
    $brandAdresse_Postale=$_POST['Adresse_Postale'];

    $sql = "INSERT INTO fournisseurs (four_name, four_contact,RCCM,CC,Siege_social,Email,Nom_Livreur,Numero_Livreur,Adresse_Postale, four_active, four_status) VALUES ('$brandName', '$brandCont','$brandRCCM','$brandCC','$brandSiege_social','$brandEmail','$brandNom_Livreur','$brandNumero_Livreur','$brandAdresse_Postale','$brandStatus', 1)";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Ajout Effectué avec Succès !";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec d'ajout";
    }


    $connect->close();

    echo json_encode($valid);
} // /if $_POST
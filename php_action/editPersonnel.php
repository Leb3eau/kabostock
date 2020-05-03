<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $nom_prenom = $_POST['nom_prenom'];
    $fonction = $_POST['fonctionPersonnel'];
    $dateFonction = $_POST['dateFonction'];
    $cnt = $_POST['contact'];
    $cni = $_POST['cni'];
    $salaire = $_POST['salaire'];
    
    $perso = $_POST['id'];

    $sql = "UPDATE personnels SET nom_prenom = '$nom_prenom', fonction = '$fonction', date_fonction='$dateFonction', contact='$cnt', cni='$cni', salaire='$salaire' WHERE id = '$perso'";

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
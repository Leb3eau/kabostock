<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    //$pjFic = $_POST['pjFic'];
    $nom_fichier = $_POST['nom_fichier1'];
    $idclt = $_POST['cltId'];
    $status = 1;

    $fichiers = $_FILES['pjFic'];
    for ($i = 0; $i < count($fichiers['name']); $i++) {
        $url = '../assests/pj/' . $fichiers['name'][$i];
        $nom_fichier .= '_'.$fichiers['name'][$i];
        if (move_uploaded_file($fichiers['tmp_name'][$i], $url)) {
            $sql = "INSERT INTO g_fichiers VALUES (NULL,'$idclt','$nom_fichier', '$url', '$status')";
            if ($connect->query($sql) === TRUE) {
                $valid['success'] = true;
                $valid['messages'] = "Ajout Effectué avec succès !";
            } else {
                $valid['success'] = false;
                $valid['messages'] = "Échec d'ajout !";
            }
        } else {
            return false;
        } // /else
    }
    $connect->close();

    echo json_encode($valid);
} // /if $_POST
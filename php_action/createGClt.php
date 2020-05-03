<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $nom_prenom = $_POST['nom_prenom'];
    $nom_fichier = $_POST['nom_fichier'];
    $status = 1;

    $sql = "INSERT INTO g_clients VALUES (NULL,'$nom_prenom', '$status')";
    if ($connect->query($sql) === TRUE) {
        $idclt = $connect->insert_id;
        
        $fichiers = $_FILES['pjImage'];
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
        
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Échec d'ajout !";
    }
    

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
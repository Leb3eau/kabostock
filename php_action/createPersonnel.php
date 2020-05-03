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
    $status = 1;

    $type = pathinfo($_FILES['personnelImage']['name'], PATHINFO_EXTENSION);
    
    
    $url = '../assests/images/persos/' . uniqid(rand()) . '.' . $type;
    
    if (in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
        if (is_uploaded_file($_FILES['personnelImage']['tmp_name'])) {
            if (move_uploaded_file($_FILES['personnelImage']['tmp_name'], $url)) {

                $sql = "INSERT INTO personnels VALUES (NULL,'$nom_prenom','$fonction', '$dateFonction', '$cnt', '$status', '$cni', '$salaire', '$url')";

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
        } // if
    } // if in_array 		

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
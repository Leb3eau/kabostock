<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $name_p = $_POST['nom_prenom'];
    $userName = $_POST['cretaeusername'];
    $p = $_POST['motpass'];
    $pass = md5($p);
    $mail = $_POST['txtmail'];
    $role = $_POST['role'];

    $sqlr = "SELECT * FROM users WHERE username = '$userName'";
    $result = $connect->query($sqlr);

    if ($result->num_rows == 0) {

        $sql = "INSERT INTO users VALUES (NULL, '$userName', '$pass', '$mail', '$role', '$name_p')";
        $azert = $connect->query($sql) or die(print_r($connect->errorInfo()));

        if ($azert == TRUE) {
            $valid['success'] = true;
            $valid['color'] = "success";
            $valid['messages'] = "Ajout Effectué avec succès !";
        } else {
            $valid['success'] = false;
            $valid['color'] = "danger";
            $valid['messages'] = "Échec d'ajout !";
        }
    } else {
        $valid['success'] = true;
        $valid['color'] = "danger";
        $valid['messages'] = "Ce nom utilisateur existe déjà !.";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
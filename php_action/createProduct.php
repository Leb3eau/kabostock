<?php

header('Content-Type: application/json');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

//    $productName = $_POST['productName'];
//    $quantity = $_POST['quantity'];
//    $ratea = $_POST['ratea'];

    $paymentType = $_POST['paymentType'];
    $paymentMode = $_POST['paymentMode'];
    $brandName = $_POST['brandName'];
    $date_livraison = $_POST['datelivraison'];
    $productStatus = 1;

    $nom_fichier = "BonLivraison_" . date('d-m-Y_His') . ".";

    $status = 1;
    $nomBrand = "";

    $sql = "SELECT four_id, four_name FROM fournisseurs WHERE four_id = '$brandName'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $nomBrand = $row[1];
        }
    }

    $sql = "SELECT * FROM g_clients WHERE nom_prenom = '$nomBrand'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $verifNomClt = $row[0];
        }
    } else {
        $verifNomClt = FALSE;
    }

    if ($verifNomClt) {
        $idclt = $verifNomClt;
    } else {
        $sql = "INSERT INTO g_clients VALUES (NULL,'$nomBrand', '$status')";
        $connect->query($sql);
        $idclt = $connect->insert_id;
    }

    if ($idclt) {

        $fichiers = $_FILES['bonLivraison'];
        // for ($i = 0; $i < count($fichiers['name']); $i++) {
        $url = '../assests/pj/' . $fichiers['name'];
        $nom_fichier .= pathinfo($fichiers['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file($fichiers['tmp_name'], $url)) {
            $sql = "INSERT INTO g_fichiers VALUES (NULL,'$idclt','$nom_fichier', '$url', '$status')";
            if ($connect->query($sql) === TRUE) {

                for ($x = 0; $x < count($_POST['productName']); $x++) {
                    $sql = "INSERT INTO product VALUES (NULL, '" . $_POST['productName'][$x] . "' ,'" . $_POST['quantity'][$x] . "', '$brandName', '" . $_POST['ratea'][$x] . "', 1, '$paymentType', '$paymentMode', '$date_livraison', '$url', '" . $_POST['quantity'][$x] . "', '$productStatus')";


                    if ($connect->query($sql) === TRUE) {
                        $prod_id = $connect->insert_id;
                        $mo = $_POST['quantity'][$x] * $_POST['ratea'][$x];
                        $sqlp = "INSERT INTO four_pay VALUES (NULL, '$brandName', '$prod_id', '$date_livraison', '".$_POST['quantity'][$x]."', '$mo', '0', '$mo')";
                        $connect->query($sqlp);
                        $valid['success'] = true;
                        $valid['messages'] = "Ajout Effectué avec succès !";
                    } else {
                        $valid['success'] = false;
                        $valid['messages'] = "Échec d'ajout !";
                    }
                }
            }
        }
    }

    $connect->close();

    echo json_encode($valid);
}
<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    
    $productId = $_POST['productId'];
    
    $type = pathinfo($_FILES['editProductImage']['name'], PATHINFO_EXTENSION);    
    $url = '../assests/images/persos/' . uniqid(rand()) . '.' . $type;    
    if (in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
        if (is_uploaded_file($_FILES['editProductImage']['tmp_name'])) {
            if (move_uploaded_file($_FILES['editProductImage']['tmp_name'], $url)) {

                $sql = "UPDATE personnels SET photo = '$url' WHERE id = $productId";

                if ($connect->query($sql) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "Modification d'image effectuée avec succès !";
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Échec de modification de l'image";
                }
            } else {
                return false;
            } // /else	
        } // if
    } // if in_array 		

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$brandId = $_POST['brandId'];

if($brandId) { 

 $sql = "UPDATE fournisseurs SET four_status = 2 WHERE four_id = {$brandId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Suppression Effectuée avec succès !";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Échec de suppression !";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST
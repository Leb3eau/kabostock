<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 $sql = "DELETE FROM charges WHERE charges_id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Suppression effectuée avec succès !";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Échec de suppression !";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST
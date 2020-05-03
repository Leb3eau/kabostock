<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$removePersoId = $_POST['removePersoId'];

if($removePersoId) { 

 $sql = "UPDATE g_clients SET status = 0 WHERE id = {$removePersoId}";

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
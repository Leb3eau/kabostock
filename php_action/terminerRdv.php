<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$removePersoId = $_POST['rdvId'];

if($removePersoId) { 

 $sql = "UPDATE rdv SET etat = 'effectif' WHERE id = {$removePersoId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "RDV effectué avec succès !";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Échec !";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST
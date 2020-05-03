<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT four_id, four_name, four_contact, four_active, four_status,RCCM,CC,Siege_social,Email,Nom_Livreur,Numero_Livreur,Adresse_Postale FROM fournisseurs WHERE four_id = $brandId ORDER BY four_id DESC";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);
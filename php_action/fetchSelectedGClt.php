<?php 	

require_once 'core.php';

$Id = $_POST['persoId'];

$sql = "SELECT * FROM g_clients WHERE id = $Id";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);
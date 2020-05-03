<?php 	

require_once 'core.php';

$sql = "SELECT id, designation FROM produits";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);
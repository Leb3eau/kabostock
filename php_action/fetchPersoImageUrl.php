<?php 	

require_once 'core.php';

$productId = $_GET['i'];

$sql = "SELECT photo FROM personnels WHERE id = {$productId}";
$data = $connect->query($sql);
$result = $data->fetch_row();

$connect->close();

echo "kabostock/" . $result[0];

<?php 	

require_once 'core.php';

$sql = "SELECT product.product_id, produits.designation FROM product, produits WHERE product.active = 1 AND product.status = 1 AND product.quantity != 0 AND product.produit_id=produits.id ORDER BY product.product_id DESC";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);
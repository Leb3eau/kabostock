<?php
include './includes/fonctionsImportantes.php';
setlocale(LC_ALL, 'fra_fra');
setlocale(LC_TIME, 'fr_FR.UTF-8');
//echo strftime('%A %d %B %Y, %H:%M'); // jeudi 11 octobre 2012, 16:03

require_once 'php_action/core.php';

if (isset($_GET['tf'])) {

    $orderId = $_GET['tf'];


    $sql = "SELECT * FROM orders WHERE order_id = $orderId";

    $orderResult = $connect->query($sql);
    $orderData = $orderResult->fetch_array();

    $orderDate = $orderData['order_date'];
    $clientName = $orderData['client_name'];
    $clientContact = $orderData['client_contact'];
    $subTotal = $orderData['sub_total'];
    $vat = $orderData['vat'];
    $totalAmount = $orderData['total_amount'];
    $discount = $orderData['discount'];
    $grandTotal = $orderData['grand_total'];
    $paid = $orderData['paid'];
    $due = $orderData['due'];


    $orderItemSql = "SELECT order_item.product_id, order_item.ratev, order_item.quantity, order_item.total,
produits.designation FROM order_item,product,produits
	WHERE order_item.product_id=product.product_id AND product.produit_id=produits.id AND order_item.order_id = $orderId";
    $orderItemResult = $connect->query($orderItemSql);

    require 'assests/fpdf/bl.php';
}
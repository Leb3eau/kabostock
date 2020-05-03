<?php
//session_start();

require_once 'php_action/core.php';

if (isset($_GET['tf']) && isset($_GET['ty'])) {

    $orderId = $_GET['tf'];

    if ($_GET['ty'] === "fact") {

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

        require 'assests/fpdf/TouteFacture.php';
    }


    if ($_GET['ty'] === "prof") {

        $sql = "SELECT * FROM devis WHERE devis_id = $orderId";

        $orderResult = $connect->query($sql);
        $orderData = $orderResult->fetch_array();

        $orderDate = $orderData['devis_date'];
        $clientName = $orderData['client_name'];
        $clientContact = $orderData['client_contact'];
        $subTotal = $orderData['sub_total'];
        $vat = $orderData['vat'];
        $totalAmount = $orderData['total_amount'];


        $orderItemSql = "SELECT devis_item.product_id, devis_item.ratev, devis_item.quantity, devis_item.total,
produits.designation FROM devis_item,product,produits
	WHERE devis_item.product_id=product.product_id AND product.produit_id=produits.id AND devis_item.devis_id = $orderId";
        $orderItemResult = $connect->query($orderItemSql);

        require 'assests/fpdf/TouteDevis.php';
    }

    if ($_GET['ty'] === "four") {

        $sql = "SELECT four_pay.*, fournisseurs.four_name FROM four_pay,fournisseurs WHERE four_pay.four_id=fournisseurs.four_id AND four_pay.id = $orderId";

        $orderResult = $connect->query($sql);
        $orderData = $orderResult->fetch_array();

        $payDate = $orderData['date'];
        $fourame = $orderData['four_name'];
        $fourId = $orderData['four_id'];
        $totalAmount = $orderData['montant_total'];
        $qte = $orderData['qte'];
        $deja_paye = $orderData['total_paiement'];
        $reste = $orderData['reste_paiement'];
        
        $sql = "SELECT four_pay.*, fournisseurs.four_name FROM four_pay,fournisseurs WHERE four_pay.four_id='$fourId' AND four_pay.date='$payDate'";

        $orderResult = $connect->query($sql);
        

        require 'assests/fpdf/toutFour.php';
    }
}
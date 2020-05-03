<?php

require_once 'php_action/core.php';

if (isset($_POST['btn_imprimer'])) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));

    $type = $_POST['type'];

    if ($type === "stock") {
        $sql = "SELECT product.product_id AS id,produits.designation AS pn, product.quantity AS stock, product.qte_initial AS initial, fournisseurs.four_name AS fournisseurs FROM produits, product, fournisseurs WHERE produits.id=product.produit_id AND product.status = 1 AND fournisseurs.four_id=product.four_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date'";
        $query = $connect->query($sql);
        require 'assests/fpdf/stockpdf.php';
    }
    
    if ($type === "depense") {
        $sql = "SELECT * FROM depenses WHERE date BETWEEN '$start_date' AND '$end_date'";
        $query = $connect->query($sql);
        require 'assests/fpdf/deppdf.php';
    }
    
    if ($type === "perso") {
        $sql = "SELECT * FROM personnels WHERE date_fonction BETWEEN '$start_date' AND '$end_date'";
        $query = $connect->query($sql);
        require 'assests/fpdf/persopdf.php';
    }

    if ($type === "bilan") {
        $sql = "SELECT produits.designation as pn, order_item.quantity AS qte, order_item.ratea as pa, order_item.ratev as pv, order_item.total AS total FROM order_item,product,orders,produits WHERE produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date'";
        $query = $connect->query($sql);

        $sql1 = "SELECT SUM(paid) AS encaissees, SUM(due) AS en_credit FROM orders WHERE order_date BETWEEN '$start_date' AND '$end_date' AND orders.order_status = 1";
        $recettes = $connect->query($sql1);
        $recettes = $recettes->fetch_all();

        $sql2 = "SELECT * FROM orders WHERE due !=0 AND order_status = 1  AND order_date BETWEEN '$start_date' AND '$end_date'";
        $clients_credit = $connect->query($sql2);

        require 'assests/fpdf/bilanpdf.php';
    }

    if ($type === "benefice") {
        $sql = "SELECT produits.designation as pn, order_item.quantity AS qte, order_item.ratea as pa, order_item.ratev as pv FROM order_item,product,orders, produits WHERE produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND orders.order_date BETWEEN '$start_date' AND '$end_date'";
        $query = $connect->query($sql);

        $sqli = "SELECT SUM(due) AS credit FROM orders WHERE order_date BETWEEN '$start_date' AND '$end_date'";
        $q = $connect->query($sqli);
        $credit = $q->fetch_all();

        $sql1 = "SELECT SUM(montant) FROM depenses WHERE date BETWEEN '$start_date' AND '$end_date'";
        $ex = $connect->query($sql1);
        $charges = $ex->fetch_all();
        
        require 'assests/fpdf/beneficepdf.php';
    }
}
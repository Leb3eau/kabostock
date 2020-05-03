<?php

require_once '../php_action/core.php';

$type = $_GET['t'];

if ($type === "produits") {
    $sql = "SELECT * FROM produits ORDER BY id DESC";
    $query = $connect->query($sql);
    require 'fpdfp.php';
}

if ($type === "provider") {
    $sql = "SELECT four_id, four_name, four_contact,RCCM,CC,Siege_social,Email,Nom_Livreur,Numero_Livreur,Adresse_Postale FROM fournisseurs WHERE four_status = 1 ORDER BY four_id DESC";
    $query = $connect->query($sql);
    require 'fpdff.php';
}

if ($type === "four") {
    $sql = "SELECT four_pay.*, fournisseurs.four_name FROM four_pay, fournisseurs, product WHERE four_pay.four_id=fournisseurs.four_id AND four_pay.prod_id = product.product_id AND product.status = 1 GROUP BY four_pay.id";
    $query = $connect->query($sql);
    require 'fpdffour.php';
}

<?php
require_once 'core.php';

$sql = "SELECT produits.*, product.ratea,product.quantity,product.payment_type,product.payment_mode,product.status,fournisseurs.four_name, product.product_id, product.active FROM produits, product, fournisseurs WHERE produits.id=product.produit_id AND product.status = 1 AND fournisseurs.four_id=product.four_id AND product.quantity = 0 ORDER BY product.product_id DESC";
$result = $connect->query($sql);

$output = array('data' => array());
if ($result->num_rows > 0) {

    
    while ($row = $result->fetch_array()) {
        $productId = $row[11];
        
        if ($row[9] == 1) {
            $active = "<label class='label label-success'>Disponible</label>";
        } else {
            $active = "<label class='label label-danger'>Non Disponible</label>";
        }

        if ($row[8] == 1) {
            $paymentMode = "<label class='label label-success'>Full Payment</label>";
        } else if ($row[8] == 2) {
            $paymentMode = "<label class='label label-info'>Acompte</label>";
        } else {
            $paymentMode = "<label class='label label-warning'>Crédit</label>";
        } // /else
        
        if ($row[7] == 1) {
            $paymentType = "<label class='label label-default'>Chèque</label>";
        } else if ($row[7] == 2) {
            $paymentType = "<label class='label label-default'>Cash</label>";
        } else {
            $paymentType = "<label class='label label-default'>Virement</label>";
        } // /else

        
        if ($row[6] == 0) {
            $stock = "<label class='label label-danger'>Rupture de Stock</label>";
        } else if ($row[6] <= 3) {
            $stock = "<label class='label label-warning'>Aletre! Stock Minimal</label>";
        }  else {
             $stock = "<label class='label label-primary'>Stock Satisfaisant</label>";
         }

           if ($_SESSION['userRole'] === "admin") {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct(' . $productId . ')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct(' . $productId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
         }else{
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct(' . $productId . ')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	  </ul>
	</div>';
             
         }
            
            $output['data'][] = array(
                //productname
                $row[1],
                //marque
                $row[2],
                //type
                $row[3],
                //pua
                $row[5],
                //qté stock
                $row[6],                
                //fournisseur
                $row[10], 
                //type payment
                $paymentType, 
                //mode paymt
                $paymentMode, 
                //active statut
                $active,
                //etat stock
                $stock,                
                //bouton
                $button
            );
        } // /while 
    }// if num_rows

    $connect->close();

    echo json_encode($output);
         
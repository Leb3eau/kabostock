<?php
require_once 'core.php';

$t= $_GET['t'];

$sql = "SELECT four_pay.*, fournisseurs.four_name FROM four_pay, fournisseurs, product WHERE four_pay.four_id=fournisseurs.four_id AND four_pay.prod_id = product.product_id AND product.status = 1 GROUP BY four_pay.id ORDER BY four_pay.id DESC";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    $x = 1;

    while ($row = $result->fetch_array()) {
        $orderId = $row[0];

        if ($row[7] == 0) {
            $paymentStatus = "<label class='label label-success'>Facture reglée</label>";
        } else {
            $paymentStatus = "<label class='label label-danger'>Facture en attente</label>";
        } 
        
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-save"></i> Paiement</a></li>

	    <li><a style="cursor:pointer" type="button" onclick="printOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-print"></i> Imprimer </a></li>
	    
	  </ul>
	</div>';

        $output['data'][] = array(
            // image
            $x,
            // fournisseur
            $row[8],
            // qte
            $row[4],
            // total
            $row[5],
            // total paiemt
            $row[6],
            // rest paiemt
            $row[7],
            // dte paiemt
            $row[3],
            //statut
            $paymentStatus,
            // button
            $button
        );
        $x++;
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

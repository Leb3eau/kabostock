<?php

require_once 'core.php';

$sql = "SELECT * FROM orders WHERE order_status = 1 ORDER BY order_id DESC";
$result = $connect->query($sql);



$output = array('data' => array());

if ($result->num_rows > 0) {

    $paymentStatus = "";
    $x = 1;

    while ($row = $result->fetch_array()) {
        $orderId = $row[0];

        $countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $orderId";
        $itemCountResult = $connect->query($countOrderItemSql);
        $itemCountRow = $itemCountResult->fetch_row();

        // active 
        if ($row['payment_status'] == 1) {
            $paymentStatus = "<label class='label label-success'>Soldé</label>";
        } else if ($row['payment_status'] == 2) {
            $paymentStatus = "<label class='label label-info'>Acompte ( Versements)</label>";
        } else {
            $paymentStatus = "<label class='label label-warning'>Crédit</label>";
        } // /else

        if ($_SESSION['userRole'] === "admin") {
        
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	   <li><a style="cursor:pointer" type="button" data-toggle="modal" id="listPaymentModalBtn" data-target="#listPaymentOrderModal" onclick="listPaymentOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-list"></i> Détails paiement</a></li>
	    
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-save"></i> Paiement</a></li>

	   <li><a target="_blank" href="imprimer.php?tf=' . $orderId . '&ty=fact"> <i class="glyphicon glyphicon-print"></i> Imprimer </a></li>
           <li><a target="_blank" href="bon.php?tf=' . $orderId . '"> <i class="glyphicon glyphicon-transfer"></i> Bon Livraison</a></li>
	    
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
        } else {
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-save"></i> Paiement</a></li>

	   <li><a target="_blank" href="imprimer.php?tf=' . $orderId . '&ty=fact"> <i class="glyphicon glyphicon-print"></i> Imprimer </a></li>
           <li><a target="_blank" href="bon.php?tf=' . $orderId . '"> <i class="glyphicon glyphicon-transfer"></i> Bon Livraison</a></li>
	    
	  </ul>
	</div>';
            
        }

        $output['data'][] = array(
            // image
            $x,
            // order date
            $row[1],
            // client name
            $row[2],
            // client contact
            $row[3],
            $itemCountRow,
            $row['grand_total'],
            $row['due'],
            $paymentStatus,
            // button
            $button
        );
        $x++;
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

<?php

require_once 'core.php';

$sql = "SELECT * FROM devis WHERE devis_status = 1 ORDER BY devis_id DESC";
$result = $connect->query($sql);



$output = array('data' => array());

if ($result->num_rows > 0) {

    $paymentStatus = "";
    $x = 1;

    while ($row = $result->fetch_array()) {
        $orderId = $row[0];

        $countOrderItemSql = "SELECT count(*) FROM devis_item WHERE devis_id = $orderId";
        $itemCountResult = $connect->query($countOrderItemSql);
        $itemCountRow = $itemCountResult->fetch_row();

        if ($_SESSION['userRole'] === "admin") {
        
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
          
	    <li><a href="devis.php?o=editOrd&i=' . $orderId . '" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	   
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="transferOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-transfer"></i> Transférer</a></li>

	    <li><a target="_blank" href="imprimer.php?tf=' . $orderId . '&ty=prof"> <i class="glyphicon glyphicon-print"></i> Imprimer </a></li>
	    
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  
        </ul>
	</div>';
        }else{
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
          
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="transferOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-transfer"></i> Transférer</a></li>

	    <li><a target="_blank" href="imprimer.php?tf=' . $orderId . '&ty=prof"> <i class="glyphicon glyphicon-print"></i> Imprimer </a></li>
	    
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
            //nbre d'articles
            $itemCountRow,
            //montant toal
            $row['total_amount'],
            // button
            $button
        );
        $x++;
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

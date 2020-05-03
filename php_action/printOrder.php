<?php

require_once 'core.php';

$orderId = $_POST['orderId'];

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

$table = '
 <table  class="table table-striped table-bordered" style="background-color: #ccccff">
	<thead>
            <th colspan="5">
                    <img src="assests/images/logo1.jpg" width="100" height="100"  class="pull-left">
			<center  class="pull-center" style="margin-top:3%">
				Date Achat : '. date("d-m-Y", strtotime($orderDate)).'
				<center>Nom Client : '.$clientName.'</center>
				Contact : '.$clientContact.'
			</center>
                    <img src="assests/images/logo1.jpg" width="100" height="100" style="margin-top:-15%" class="pull-right">
			</th>		
	</thead>
</table>

<table class="table table-striped table-bordered">

	<thead>
			<th>N°</th>
			<th>Produits</th>
			<th>Prix Unitaire</th>
			<th>Quantité</th>
			<th>Montant Total</th>
		</thead>
                <tbody>';

$x = 1;
while ($row = $orderItemResult->fetch_array()) {

    $table .= '<tr>
				<th>' . $x . '</th>
				<th>' . $row[4] . '</th>
				<th>' . $row[1] . '</th>
				<th>' . $row[2] . '</th>
				<th>' . $row[3] . '</th>
			</tr>
			';
    $x++;
} // /while

$table .= '</tbody>
    <tr>
	<th colspan="5"></th>
    </tr>
    <tr>
			<th colspan="3">Montant HT</th>
			<th colspan="2">' . $subTotal . '</th>			
		</tr>

		<tr>
			<th colspan="3">TVA (18%)</th>
			<th colspan="2">' . $vat . '</th>			
		</tr>

		<tr>
			<th colspan="3">Montant Total</th>
			<th colspan="2">' . $totalAmount . '</th>			
		</tr>	

		<tr>
			<th colspan="3">Remise</th>
			<th colspan="2">' . $discount . '</th>			
		</tr>

		<tr>
			<th colspan="3">Montant à Payer</th>
			<th colspan="2">' . $grandTotal . '</th>			
		</tr>

		<tr>
			<th colspan="3">Montant Payé</th>
			<th colspan="2">' . $paid . '</th>			
		</tr>

		<tr>
			<th colspan="3">Reste à payer</th>
			<th colspan="2">' . $due . '</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;

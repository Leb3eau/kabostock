<?php

require_once 'core.php';

if ($_POST) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));


    $sql = "SELECT produits.designation as pn, SUM(order_item.quantity) AS qte, product.ratea as pa, order_item.rate as pv, fournisseurs.four_name AS four FROM order_item,product,orders, produits, fournisseurs WHERE fournisseurs.four_id=product.four_id AND produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND orders.order_date BETWEEN '$start_date' AND '$end_date' GROUP BY produits.designation,product.ratea,order_item.rate,fournisseurs.four_name";
    $query = $connect->query($sql);

    $table = '<center><h3>BÉNÉFICES DU <span class="label label-default">' . $start_date_affic . '</span> AU <span class="label label-default">' . $end_date_aff . '</span></h3></center>
                    <br><br>';
	$table .= '
	<table class="table table-bordered">
		<thead class="warning" background-color: #ccccff;>
			<th style="text-align:center" class="warning">Fournisseurs</th>
			<th style="text-align:center" class="warning">Quantité Vendue</th>
                        <th style="text-align:center" class="warning">Total</th>
		</thead>
		<tbody>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
                    $ben = $result['pv']-$result['pa'];
                    $bt = $ben*$result['qte'];
                    $table .= '<tr>
				<td><center>'.$result['four'].'</center></td>
				<td><center>'.$result['qte'].'</center></td>
				<td><center>'.$bt.'</center></td>
			</tr>';                        
		}                
                
		$table .= '
		</tbody>
	</table>';	

	echo $table;

}
?>
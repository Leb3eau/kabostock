<?php
require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT four_pay.*, fournisseurs.four_name FROM four_pay,fournisseurs WHERE four_pay.four_id=fournisseurs.four_id AND four_pay.id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$payDate = $orderData['date'];
$fourame = $orderData['four_name'];
$totalAmount = $orderData['montant_total'];
$qte = $orderData['qte'];
$deja_paye = $orderData['total_paiement'];
$reste = $orderData['reste_paiement'];

$table = '
 <table  class="table table-striped table-bordered" style="background-color: #ccccff">
	<thead>
            <th colspan="5">
                    <img src="assests/images/logo1.jpg" width="100" height="100"  class="pull-left">
			<center  class="pull-center" style="margin-top:3%">
				Date Achat : ' . date("d-m-Y", strtotime($payDate)) . '
				<center>Nom Fournisseur : ' . $fourame . '</center>				
			</center>
                    <img src="assests/images/logo1.jpg" width="100" height="100" style="margin-top:-10%" class="pull-right">
	    </th>
	</thead>
</table>
<table class="table table-striped table-bordered">
	<thead>
			<th>Date</th>
			<th>Quantité</th>
			<th>Montant Total</th>
			<th>Date Paiement</th>
                        <th>Montant Payé</th>
			<th>Reste à payer</th>			
		</thead>
                <tbody>';

    $table .= '<tr>
				<th>' . $qte . '</th>
				<th>' . $totalAmount . '</th>
				<th>' . date("d-m-Y", strtotime($payDate)) . '</th>
				<th>' . $deja_paye . '</th>
				<th>' . $reste . '</th>
			</tr>
			'; 
$table .= '</tbody>	
</table>
 ';


$connect->close();

echo $table;

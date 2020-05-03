<?php

require_once 'core.php';
/*
SELECT produits.designation as pn, product.quantity AS quantity, SUM(order_item.quantity) AS qte, product.ratea as pa FROM order_item,product,orders, produits WHERE produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date' GROUP BY produits.designation,product.ratea,order_item.rate,product.quantity*/

if ($_POST) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));

    $sql = "SELECT produits.designation as pn, order_item.quantity AS qte, order_item.ratea as pa, order_item.ratev as pv, order_item.total AS total FROM order_item,product,orders,produits WHERE produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date'";
    $query = $connect->query($sql);
    
    $sql1 = "SELECT SUM(paid) AS encaissees, SUM(due) AS en_credit FROM orders WHERE order_date BETWEEN '$start_date' AND '$end_date' AND orders.order_status = 1";
    $recettes = $connect->query($sql1);
    $recettes = $recettes->fetch_all(); 
    
    $sql2 = "SELECT * FROM orders WHERE due !=0 AND order_status = 1  AND order_date BETWEEN '$start_date' AND '$end_date'";
    $clients_credit = $connect->query($sql2);
    
    $table = "<center><h3>
        <form target='_blank' action='sauvegarder.php' method='POST'>
                    <input type='hidden' value='$start_date' name='startDate'>
                    <input type='hidden' value='$end_date' name='endDate'>
                    <input type='hidden' value='bilan' name='type'>
                    <button type='submit' name='btn_imprimer' class='btn btn-danger pull-right'><i class='glyphicon glyphicon-print'></i></button>
                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BILAN DU <span class='label label-default'>$start_date_affic</span> AU <span class='label label-default'>$end_date_aff</span></h3></center>
                    <br>";
    $table .= '
	<table class="table table-bordered" style="width:95%; margin-left:2.5%">
		<thead class="warning" background-color: #ccccff;>
			<th style="text-align:center" class="warning">Entités</th>
			<th style="text-align:center" class="warning">Quantité Vendue</th>
			<th style="text-align:center" class="warning">Prix d\'achat</th>
                        <th style="text-align:center" class="warning">Prix Vente</th>
                        <th style="text-align:center" class="warning">Montant Total Vendu</th>
		</thead>
		<tbody>';
   
    if(!empty($query)){
    while ($result = $query->fetch_assoc()) {
        
        $table .= '<tr>
				<td><center>' . $result['pn'] . '</center></td>
				<td><center>' . $result['qte'] . '</center></td>
				<td><center>' . $result['pa'] . '</center></td>
                                <td><center>' . $result['pv'] . '</center></td>
                                <td><center>' . $result['total'] . '</center></td>
			</tr>';
    }}
    
    $table .= '
		</tbody>
                <tr><td colspan="6"></td></tr>
                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Recettes Encaissées</center></b></td>
			<td colspan="2"><b><center>' . $recettes[0][0] . '</center></b></td>
		</tr>
                                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Recettes en crédit</center></b></td>
			<td colspan="2"><b><center>' . $recettes[0][1] . '</center></b></td>
		</tr>                
	</table> <br><br><br><br><br><br>
	';
    
    $table .= '<center><h3>LISTE DES CLIENTS DÉBITEURS</h3></center>
                    <br>
	<table class="table table-bordered" style="width:95%; margin-left:2.5%">
		<thead class="warning" background-color: #fcf8e3;>
			<th style="text-align:center" class="warning">Date d\'achat</th>
			<th style="text-align:center" class="warning">Nom Client</th>
			<th style="text-align:center" class="warning">Contact Client</th>
                        <th style="text-align:center" class="warning">Montant Total</th>
                        <th style="text-align:center" class="warning">Remise</th>
                        <th style="text-align:center" class="warning">Montant Total Définitif</th>
                        <th style="text-align:center" class="warning">Montant Payé</th>
                        <th style="text-align:center" class="warning">Montant Restant</th>
		</thead>
		<tbody>';
   
    if(!empty($clients_credit)){
    while ($result = $clients_credit->fetch_assoc()) {
        
        $table .= '<tr>
                        <td><center>' . date('d-m-Y', strtotime($result['order_date'])). '</center></td>
                        <td><center>' . $result['client_name'] . '</center></td>
                        <td><center>' . $result['client_contact'] . '</center></td>
                        <td><center>' . $result['total_amount'] . '</center></td>
                        <td><center>' . $result['discount'] . '</center></td>
                        <td><center>' . $result['grand_total'] . '</center></td>
                        <td><center>' . $result['paid'] . '</center></td>
                        <td><center>' . $result['due'] . '</center></td>
		</tr>';
    }}
    
    $table .= '
		</tbody>                               
	</table>
	';


    echo $table;
}
?>
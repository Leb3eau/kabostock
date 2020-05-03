<?php

require_once 'core.php';

if ($_POST) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));


    $sql = "SELECT produits.designation as pn, order_item.quantity AS qte, order_item.ratea as pa, order_item.ratev as pv FROM order_item,product,orders, produits WHERE produits.id=product.produit_id AND orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND orders.order_date BETWEEN '$start_date' AND '$end_date'";
    $query = $connect->query($sql);

    $sqli = "SELECT SUM(due) AS credit FROM orders WHERE order_date BETWEEN '$start_date' AND '$end_date'";
    $q = $connect->query($sqli);
    $credit = $q->fetch_all();

    $sql1 = "SELECT SUM(montant) FROM depenses WHERE date BETWEEN '$start_date' AND '$end_date'";
    $ex = $connect->query($sql1);
    $charges = $ex->fetch_all();

    $table = "<center><h3><form target='_blank' action='sauvegarder.php' method='POST'>
                    <input type='hidden' value='$start_date' name='startDate'>
                    <input type='hidden' value='$end_date' name='endDate'>
                    <input type='hidden' value='benefice' name='type'>
                    <button type='submit' name='btn_imprimer' class='btn btn-danger pull-right'><i class='glyphicon glyphicon-print'></i></button>
                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BÉNÉFICES DU <span class='label label-default'> $start_date_affic </span> AU <span class='label label-default'>$end_date_aff </span></h3></center>
                    <br><br>";
    $table .= '
	<table class="table table-bordered">
		<thead class="warning" background-color: #ccccff;>
			<th style="text-align:center" class="warning">Entités</th>
			<th style="text-align:center" class="warning">Quantité Vendue</th>
			<th style="text-align:center" class="warning">Prix d\'achat</th>
			<th style="text-align:center" class="warning">Prix de vente</th>
                        <th style="text-align:center" class="warning">Bénéfice Unitaire</th>
                        <th style="text-align:center" class="warning">Total</th>
		</thead>
		<tbody>';
    $totalAmount = 0;
    while ($result = $query->fetch_assoc()) {
        $ben = $result['pv'] - $result['pa'];
        $bt = $ben * $result['qte'];
        $table .= '<tr>
				<td><center>' . $result['pn'] . '</center></td>
				<td><center>' . $result['qte'] . '</center></td>
				<td><center>' . $result['pa'] . '</center></td>
				<td><center>' . $result['pv'] . '</center></td>
				<td><center>' . $ben . '</center></td>
				<td><center>' . $bt . '</center></td>
			</tr>';
        $totalAmount += $bt;
    }


    if ($charges[0][0] == NULL) {
        $char = 0;
    } else {
        $char = $charges[0][0];
    }
    $bn = $totalAmount - $char;
    $mec = $bn - $credit[0][0];
    $table .= '
		</tbody>
                <tr><td colspan="6"></td></tr>
                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Bénéfice Brut</center></b></td>
			<td colspan="2"><b><center>' . $totalAmount . '</center></b></td>
		</tr>
                                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Charges & Dépenses</center></b></td>
			<td colspan="2"><b><center>' . $char . '</center></b></td>
		</tr>
                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Bénéfice Net</center></b></td>
			<td colspan="2"><b><center>' . $bn . '</center></b></td>
		</tr>
                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Crédit</center></b></td>
			<td colspan="2"><b><center>' . $credit[0][0] . '</center></b></td>
		</tr>
                
		<tr class="success" style="background-color: #dff0d8;">
			<td colspan="4"><b><center>Montant en Caisse </center></b></td>
			<td colspan="2"><b><center>' .$mec . '</center></b></td>
		</tr>
	</table>
        <br><br><br>';
    $table .= '
        <h3><center>GESTION BÉNÉFICES</center></h3>
	<table class="table table-bordered">
		<thead class="warning" background-color: #fcf8e3;>
			<th style="text-align:center" class="warning">Part KABORÉ</th>
			<th style="text-align:center" class="warning">Part ASSOCIÉ</th>
		</thead>
		<tbody>';

    $kaboss = $mec * 0.65;
    $asso = $mec * 0.35;

    $table .= '<tr>
				<td><center>' . $kaboss . '</center></td>
				<td><center>' . $asso . '</center></td>
			</tr>';

    echo $table;
}
?>
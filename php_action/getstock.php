<?php

require_once 'core.php';

if ($_POST) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));

    $sql = "SELECT product.product_id AS id,produits.designation AS pn, product.quantity AS stock, product.qte_initial AS initial, fournisseurs.four_name AS fournisseurs FROM produits, product, fournisseurs WHERE produits.id=product.produit_id AND product.status = 1 AND fournisseurs.four_id=product.four_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date'";
    $query = $connect->query($sql);

    $table = "<center><h3>GESTION DU STOCK - <span class='label label-default'>$start_date_affic</span> AU <span class='label label-default'>$end_date_aff</span></h3></center>
                    <br>";
    $table .= '
	<table class="table table-bordered" style="width:95%; margin-left:2.5%">
		<thead class="warning" background-color: #ccccff;>
			<th style="text-align:center" class="warning">Libellé</th>
			<th style="text-align:center" class="warning">Fournisseur</th>
			<th style="text-align:center" class="warning">Quantité Initiale</th>
			<th style="text-align:center" class="warning">Quantité Vendue</th>
			<th style="text-align:center" class="warning">Quantité en Stock</th>
                        <th style="text-align:center" class="warning">État</th>
		</thead>
		<tbody>';
    $totalAmount = 0;
    //var_dump($query);die();
    if (!empty($query)) {
        while ($result = $query->fetch_assoc()) {
            $id = $result['id'];
            
            $sql = "SELECT SUM(order_item.quantity) AS qte_vendue FROM order_item,product,orders WHERE orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND product.product_id='$id'";
            $qte_v = $connect->query($sql);
            $qte_vendue = $qte_v->fetch_all();
           
            if ($result['stock'] == 0) {
                $stock = "<label class='label label-danger'>Rupture de Stock</label>";
            } else if ($result['stock'] <= 6) {
                $stock = "<label class='label label-warning'>Aletre! Stock Minimal</label>";
            } else {
                $stock = "<label class='label label-primary'>Stock Satisfaisant</label>";
            }
            $table .= '<tr>
				<td><center>' . $result['pn'] . '</center></td>
				<td><center>' . $result['fournisseurs'] . '</center></td>
				<td><center>' . $result['initial'] . '</center></td>
				<td><center>' . $qte_vendue[0][0] . '</center></td>
                                <td><center>' . $result['stock'] . '</center></td>
				<td><center>' . $stock . '</center></td>
			</tr>';
        }
    }
    $table .= "</tbody>"
            . "</table>"
            . "<br>"
            . "<form target='_blank' action='sauvegarder.php' method='POST'>
                    <input type='hidden' value='$start_date' name='startDate'>
                    <input type='hidden' value='$end_date' name='endDate'>
                    <input type='hidden' value='stock' name='type'>
                    <button type='submit' name='btn_imprimer' class='btn btn-danger pull-right'><i class='glyphicon glyphicon-print'></i> Sauvegarder</button>
                </form>";

    echo $table;
}
?>
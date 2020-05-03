<?php

require_once 'core.php';

if ($_POST) {

    $start_date = $_POST['startDate'];
    $start_date_affic = date("d-m-Y", strtotime($start_date));

    $end_date = $_POST['endDate'];
    $end_date_aff = date("d-m-Y", strtotime($end_date));

    $sql = "SELECT product.date_livraison AS dte, produits.designation AS libelle, product.qte_initial AS qte, product.ratea AS pa, product.ratea*product.qte_initial AS mont, fournisseurs.four_name AS four FROM produits,product,fournisseurs WHERE produits.id=product.produit_id AND fournisseurs.four_id=product.four_id AND product.date_livraison BETWEEN '$start_date' AND '$end_date'";
    $query = $connect->query($sql);
    
    $table = "<center><h3>DÉPENSES - ACHATS PRODUITS DU <span class='label label-default'>$start_date_affic</span> AU <span class='label label-default'>$end_date_aff</span></h3></center>
                    <br>";
    $table .= '
	<table class="table table-bordered" style="width:95%; margin-left:2.5%">
		<thead class="warning" background-color: #ccccff;>                
			<th style="text-align:center" class="warning">Date</th>
			<th style="text-align:center" class="warning">Entités</th>
			<th style="text-align:center" class="warning">Quantité</th>
			<th style="text-align:center" class="warning">Prix d\'achat</th>
                        <th style="text-align:center" class="warning">Montant total</th>
                        <th style="text-align:center" class="warning">Fournisseur</th>
		</thead>
		<tbody>';
    
    if(!empty($query)){
    while ($result = $query->fetch_assoc()) {
        
        $table .= '<tr>
				<td><center>' . $result['dte'] . '</center></td>
				<td><center>' . $result['libelle'] . '</center></td>
				<td><center>' . $result['qte'] . '</center></td>
				<td><center>' . $result['pa'] . '</center></td>
                                <td><center>' . $result['mont'] . '</center></td>
                                <td><center>' . $result['four'] . '</center></td>
			</tr>';
    }}


    echo $table;
}
?>
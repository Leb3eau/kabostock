<?php 

require_once 'core.php';

if($_POST) {

	$start_date = $_POST['datedebut'];
	$end_date = $_POST['datefin'];
        $start_date_affic = date("d-m-Y", strtotime($start_date));
        $end_date_aff = date("d-m-Y", strtotime($end_date));
	
	$sql = "SELECT * FROM depenses WHERE date BETWEEN '$start_date' AND '$end_date'";
	$query = $connect->query($sql);

	$table = '<h3 class="text-center"> Liste des dépenses du <span class="label label-default">'.$start_date_affic.'</span> au <span class="label label-default">'.$end_date_aff.'</span></h3> <br>
	<table class="table table-striped table-bordered" style="width:100%;">
		<thead>
			<th>#</th>
			<th>Date</th>
			<th>Type</th>
                        <th>Description</th>
                        <th>Montant</th>
		</thead>

		<tbody>';
		$ix = 1;
                $mont = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$ix.'</center></td>
				<td><center>'.date("d-m-Y", strtotime($result['date'])).'</center></td>
				<td><center>'.$result['type'].'</center></td>
				<td><center>'.$result['libelle'].'</center></td>
				<td><center>'.$result['montant'].'</center></td>
			</tr>';	
                        $mont += $result['montant'];
			$ix++;
		}
		$table .= '
		</tbody>

		<tr>
			<td colspan="3"><center>TOTAL</center></td>
			<td colspan="2"><center>'.$mont.'</center></td>
		</tr>
	</table>
	';
      $table .="<br>"
            . "<form target='_blank' action='sauvegarder.php' method='POST'>
                    <input type='hidden' value='$start_date' name='startDate'>
                    <input type='hidden' value='$end_date' name='endDate'>
                    <input type='hidden' value='depense' name='type'>
                    <button type='submit' name='btn_imprimer' class='btn btn-danger pull-right'><i class='glyphicon glyphicon-print'></i> Sauvegarder</button>
                </form>";

	echo $table;

}

?>
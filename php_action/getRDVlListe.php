<?php 

require_once 'core.php';

if($_POST) {

	$start_date = $_POST['datedebut'];
	$end_date = $_POST['datefin'];
        $start_date_affic = date("d-m-Y", strtotime($start_date));
        $end_date_aff = date("d-m-Y", strtotime($end_date));
	
	
	$sql = "SELECT * FROM rdv WHERE status=1 AND date BETWEEN '$start_date' AND '$end_date'";
	$query = $connect->query($sql);

	$table = '<h3 class="text-center"> Liste des RDV du <span class="label label-default">'.$start_date_affic.'</span> au <span class="label label-default">'.$end_date_aff.'</span></h3> <br>
	<table class="table table-striped table-bordered" style="width:100%;">
		<thead>
                            <th>#</th>
                            <th>Client</th>
                            <th>Contact</th>
                            <th>Description</th>
                            <th>Lieu</th>
                            <th>Date</th>
                            <th>Heure</th>
		</thead>

		<tbody>';
		$ix = 1;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$ix.'</center></td>
				<td><center>'.$result['client'].'</center></td>
				<td><center>'.$result['contact'].'</center></td>
				<td><center>'.$result['description'].'</center></td>
				<td><center>'.$result['lieu'].'</center></td>
				<td><center>'.$result['date'].'</center></td>
				<td><center>'.$result['heure'].'</center></td>
			</tr>';	
			$ix++;
		}
		$table .= '
		</tbody>

		<tr>
			<td colspan="4"><center>TOTAL</center></td>
			<td colspan="3"><center>'.$query->num_rows.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>
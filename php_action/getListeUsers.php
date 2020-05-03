<?php

require_once 'core.php';

if ($_POST['l']) {    
    $sql = "SELECT * FROM users";
    $query = $connect->query($sql);
    
    $table = '<h3 class="text-center"> Liste des utilisateurs </h3> <br>
	<table class="table table-striped table-bordered" style="width:100%;">
		<thead>
			<th>#</th>
			<th>Username</th>
			<th>Email</th>
			<th>Rôle</th>
		</thead>

		<tbody>';
		$ix = 1;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$ix.'</center></td>
				<td><center>'.$result['username'].'</center></td>
				<td><center>'.$result['email'].'</center></td>
				<td><center>'.$result['role'].'</center></td>
				
			</tr>';	
			$ix++;
		}
		$table .= '
		</tbody>

		<tr>
			<td colspan="2"><center>TOTAL</center></td>
			<td colspan="1"><center>'.$query->num_rows.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>
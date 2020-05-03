<?php 	

require_once 'core.php';

$sql = "SELECT four_id, four_name, four_contact, four_active, four_status,RCCM,CC,Siege_social,Email,Nom_Livreur,Numero_Livreur,Adresse_Postale FROM fournisseurs WHERE four_status = 1 ORDER BY four_id DESC";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	if($row[3] == 1) {
 		// activate member
 		$activeBrands = "<label class='label label-success'>Disponible</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='label label-danger'>Non Disponible</label>";
 	}
if ($_SESSION['userRole'] === "admin") {
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
}else{
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a style="cursor:pointer" type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	   </ul>
	</div>';
    
}

 	$output['data'][] = array( 		
 		$row[1], //designation 		
 		$row[2], //contacts		
 		$row[5],//rccm 		
 		$row[6], 		//cc
 		$row[7],//siège social
 		$row[8],//email 		
 		$row[9], //nom livreur 		 		
 		$row[10],//num livreur 		
 		$row[11],//@postale 		
 		//$row[4], 		
 		//$activeBrands,//pour disponible
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
<?php

require_once 'core.php';

$sql = "SELECT * FROM rdv WHERE status = 1 ORDER BY id DESC";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {
        $categoriesId = $row[0];
if ($_SESSION['userRole'] === "admin") {
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="reporterModalBtn" data-target="#reporterBrandModel" onclick="reporter(' . $categoriesId . ')"> <i class="glyphicon glyphicon-calendar"></i> Reporter</a></li>
	    <li><a type="button" data-toggle="modal" id="terminerModalBtn" data-target="#terminerBrandModel" onclick="terminer(' . $categoriesId . ')"> <i class="glyphicon glyphicon-check"></i> Terminer</a></li>
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editBrandModel" onclick="editBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-pencil"></i> Editer</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" id="removeCategoriesModalBtn" onclick="removeBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
}else{
        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="reporterModalBtn" data-target="#reporterBrandModel" onclick="reporter(' . $categoriesId . ')"> <i class="glyphicon glyphicon-calendar"></i> Reporter</a></li>
	    <li><a type="button" data-toggle="modal" id="terminerModalBtn" data-target="#terminerBrandModel" onclick="terminer(' . $categoriesId . ')"> <i class="glyphicon glyphicon-check"></i> Terminer</a></li>
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editBrandModel" onclick="editBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-pencil"></i> Editer</a></li>
	  </ul>
	</div>';
    
}
        
        

        
        $output['data'][] = array(
            $row[1],
            $row[2],
            $row[3],
            $row[4],
            date('d-m-Y', strtotime($row[5])),
            $row[6],
            $row[7],
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

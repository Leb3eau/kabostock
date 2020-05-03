<?php

require_once 'core.php';

$sql = "SELECT * FROM personnels WHERE status = 1 ORDER BY id DESC";
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
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editBrandModel" onclick="editBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" id="removeCategoriesModalBtn" onclick="removeBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
        }else{
            $button='';
        }

        $imageUrl = substr($row[8], 3);
        $productImage = "<img class='img-round' src='" . $imageUrl . "' style='height:50px; width:50px;'  />";

        $output['data'][] = array(
            $productImage,
            $row[1],
            $row[6],
            $row[4],
            $row[2],
            $row[3],
            $row[7],
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

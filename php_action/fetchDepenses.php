<?php

require_once 'core.php';

$sql = "SELECT * FROM depenses ORDER BY id DESC";
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
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories(' . $categoriesId . ')"> <i class="glyphicon glyphicon-edit"></i> Editer</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories(' . $categoriesId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    </ul>
	</div>';
        }

        $output['data'][] = array(
            $row[1],
            $row[4],
            $row[2],
            $row[3],
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

<?php

require_once 'core.php';

$sql = "SELECT * FROM g_clients WHERE status = 1 ORDER BY id DESC";
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
	    <li><a type="button" data-toggle="modal" data-target="#ajouterFichier" id="addFicModalBtn" onclick="addFic(' . $categoriesId . ')"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Fichiers</a></li>       
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" id="removeCategoriesModalBtn" onclick="removeBrands(' . $categoriesId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
          }else{
              $button='';
          }

        $apercu = '<a href="http://localhost:81/kabostock/g_clients.php?clt='.$categoriesId.'" class="btn btn-info apercu"> Aperçu </a>';
//        
//        $imageUrl = substr($row[3], 3);
//        $productImage = "<a href='" . $imageUrl . "' download='" . $row[1]."_".$row[2]. "'>Télécharger</a>";

        $output['data'][] = array(
            $row[1],
            $apercu,
//            $row[2],
//            $productImage,
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

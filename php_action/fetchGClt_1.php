<?php

require_once 'core.php';

$sql = "SELECT * FROM g_fichiers WHERE id_clt = ".$_GET['clt']." ORDER BY id DESC";
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
	    <li><a type="button" onclick="removeFic(' . $categoriesId . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
               }else{
                   $button='';
               }

        //$apercu = '<a href="http://localhost:81/kabostock/g_clients.php?clt='.$categoriesId.'" class="btn btn-info apercu"> Aperçu </a>';
       
        $imageUrl = substr($row[3], 3);
        $productImage = "<a href='" . $imageUrl . "' download='" . $row[1]."_".$row[2]. "'>Télécharger</a>";

        $output['data'][] = array(
            $row[2],
            $productImage,
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);

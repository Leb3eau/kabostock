<?php

require 'php_action/core.php';

if (isset($_POST['rdv'])) {
    $req = "SELECT * FROM rdv WHERE status = 1 AND etat = 'En cours'";
    $rdv = $connect->query($req);
    $rdv = $rdv->fetch_all();
    echo json_encode($rdv);
}

if (isset($_POST['clt'])) {
    $output = "";
    $req = "SELECT * FROM g_fichiers WHERE id_clt ='" . $_POST['clt'] . "'";
    $rdv = $connect->query($req);
    $rdv = $rdv->fetch_all();
    $output .= '<thead>
                        <tr>							
                            <th>Nom Fichier</th>
                            <th>Fichiers</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                    <tbody>';
    
    foreach ($rdv as $key => $value) {
        $imageUrl = substr($value['photo'], 3);
        $productImage = "<a href='" . $imageUrl . "' download='" . $value[1]."_".$value[2]. "'>Télécharger</a>";

        $button = '<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" id="removeCategoriesModalBtn" onclick="removeBrands(' . $value[0] . ')"> <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
	  </ul>
	</div>';
        
        $output .='<tr>							
                            <td>'.$value[2].'</td>
                            <td>'.$productImage.'</td>
                            <td>'.$button.'</td>
                        </tr>';
    }
    
    $output .='</tbody></table>';
    
    echo $output;
}
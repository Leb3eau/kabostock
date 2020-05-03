<?php

require_once 'php_action/db_connect.php';
require_once 'includes/header.php';
?>
<input type="hidden" id="dr" value="cr_four"/>

<ol class="breadcrumb">
    <li><a href="dashboard.php">Accueil</a></li>
    <li>Créances</li>
    <li class="active">
        Fournisseurs
    </li>
</ol>

<h4>
    <i class='glyphicon glyphicon-circle-arrow-right'></i>
    CRÉANCES FOURNISSEURS
</h4>

<div class="panel panel-default">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-edit"></i> Créance Fournisseurs        
    </div> <!--/panel-->	
    <div class="panel-body">

        <div id="success-messages"></div>

        <div class="div-action pull pull-right" style="padding-bottom:20px;">
            <select name="" id="type" class="form-control">
                <option value="">~~Choisir le mode de paiement</option>
                <option value="1">Paiement Complet</option>
                <option value="2">Acompte (Versement)</option>
                <option value="3">Crédit</option>
            </select>
        </div>

        <table class="table" id="manageOrderTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fournisseur</th>
                    <th>Quantité Produits</th>
                    <th>Montant Total</th>
                    <th>Total Paiement</th>
                    <th>Reste à payer</th>
                    <th>Date Paiement</th>
                    <th>État Facture</th>
                </tr>
            </thead>
        </table>
    </div> <!--/panel-->	
</div> <!--/panel-->	

<script src="custom/js/creances12.js"></script>

<?php require_once 'includes/footer.php'; ?>



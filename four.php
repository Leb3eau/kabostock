<?php

require_once 'php_action/db_connect.php';
require_once 'includes/header.php';
?>
<input type="hidden" id="dr" value="four"/>

<ol class="breadcrumb">
    <li><a href="dashboard.php">Accueil</a></li>
    <li>Comptabilité</li>
    <li class="active">
        Fournisseurs
    </li>
</ol>

<h4>
    <i class='glyphicon glyphicon-circle-arrow-right'></i>
    COMPTABILITÉ FOURNISSEURS
</h4>

<div class="panel panel-default">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-edit"></i> Comptabilité Fournisseurs        
    </div> <!--/panel-->	
    <div class="panel-body">

        <div id="success-messages"></div>

        <div class="div-action pull pull-left" style="">
            <a target="_blank" class="btn btn-default button1" href="listes/imprimer.php?t=four"> <i class="glyphicon glyphicon-print"></i> Imprimer </a>
        </div><br/><br />

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
                    <th>Option</th>
                </tr>
            </thead>
        </table>
    </div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Édition du Paiement</h4>
            </div>      

            <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                <div class="paymentOrderMessages"></div>


                <div class="form-group">
                    <label for="due" class="col-sm-3 control-label">Total Montant</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total" name="total" disabled="true" />					
                    </div>
                </div> <!--/form-group-->		
                <div class="form-group">
                    <label for="due" class="col-sm-3 control-label">Reste à payer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="due" name="due" disabled="true" />					
                    </div>
                </div> <!--/form-group-->		
                <div class="form-group">
                    <label for="payAmount" class="col-sm-3 control-label">Montant Payé</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
                    </div>
                </div> <!--/form-group-->                							  				  
                <div class="form-group">
                    <label for="payAmount" class="col-sm-3 control-label">Date Paiement</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="payDate" name="payDate"/>					      
                    </div>
                </div> <!--/form-group-->                							  				  

            </div> <!--/modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeFermer"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les Modifications</button>	
            </div>           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<script src="custom/js/list.js"></script>

<?php require_once 'includes/footer.php'; ?>



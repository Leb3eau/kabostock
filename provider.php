<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12" style="width: 105%; margin-left: -2%">

        <ol class="breadcrumb">
            <li><a href="dashboard.php"> Accueil </a></li>		  
            <li class="active">Fournisseur </li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion des Fournisseurs</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-left" style="">
                    <a target="_blank" class="btn btn-default button1" href="listes/imprimer.php?t=provider"> <i class="glyphicon glyphicon-print"></i> Imprimer </a>
                </div>
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Un fournisseur </button>
                </div> <!-- /div-action -->				

                <table class="table responsive" id="manageBrandTable">
                    <thead>
                        <tr>							
                            <th>Désignation</th>
                            <th>Contacts</th>
                            <th>RCCM</th>
                            <th>CC</th>
                            <th>Siege_social</th>
                            <th>Email</th>
                            <th>Nom_Livreur</th>
                            <th>Numero_Livreur</th>
                            <th>Adresse_Postale</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createProvider.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter fournisseur </h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Désignation : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="brandName" placeholder="Nom du fournisseur" name="brandName" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Contact : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="contactFourn" placeholder="Contact du fournisseur" name="contactFourn" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                        <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">RCCM : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="RCCM" placeholder="RCCM du fournisseur" name="RCCM" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">CC : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="CC" placeholder="CC du fournisseur" name="CC" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Siege_social : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Siege_social" placeholder="Siege_social du fournisseur" name="Siege_social" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Email : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="Email" placeholder="Email du fournisseur" name="Email" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Nom_Livreur : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Nom_Livreur" placeholder="Nom_Livreur du fournisseur" name="Nom_Livreur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Numero_Livreur : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Numero_Livreur" placeholder="Numero_Livreur du fournisseur" name="Numero_Livreur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Adresse_Postale : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Adresse_Postale" placeholder="Adresse_Postale du fournisseur" name="Adresse_Postale" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="brandStatus" class="col-sm-3 control-label">Statut: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="brandStatus" name="brandStatus">
                                <option value="">~~CHOISIR~~</option>
                                <option value="1">Disponible</option>
                                <option value="2">Non Disponible</option>
                            </select>
                        </div>
                    </div> <!-- /form-group-->	         	        

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

                    <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Enregistrer</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit brand -->
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editBrandForm" action="php_action/editProvider.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Modifications du fournisseur</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-brand-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-brand-result">
                        <div class="form-group">
                            <label for="editBrandName" class="col-sm-3 control-label">Désignation : </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editBrandName" placeholder="Designation du fournisseur" name="editBrandName" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->	         	        
                        <div class="form-group">
                            <label for="editBrandName" class="col-sm-3 control-label">Contact : </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ContactFournisseur" placeholder="Contact du fournisseur" name="editContact" autocomplete="off">
                            </div>
                        </div>
                        
                            <div class="form-group">
                        <label for="RCCM" class="col-sm-3 control-label">RCCM : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editRCCM" placeholder="RCCM du fournisseur" name="RCCM" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="CC" class="col-sm-3 control-label">CC : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editCC" placeholder="CC du fournisseur" name="CC" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Siege_social: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editSiege_social" placeholder="Siege_social du fournisseur" name="Siege_social" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Email : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="editEmail" placeholder="Email du fournisseur" name="Email" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Nom_Livreur : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editNom_Livreur" placeholder="Nom_Livreur du fournisseur" name="Nom_Livreur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Numero_Livreur : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editNumero_Livreur" placeholder="Numero_Livreur du fournisseur" name="Numero_Livreur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="Adresse_Postale" class="col-sm-3 control-label">Adresse_Postale: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editAdresse_Postale" placeholder="Adresse_Postale du fournisseur" name="Adresse_Postale" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                        <div class="form-group">
                            <label for="editBrandStatus" class="col-sm-3 control-label">Statut: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editBrandStatus" name="editBrandStatus">
                                    <option value="">~~CHOISIR~~</option>
                                    <option value="1">Disponible</option>
                                    <option value="2">Non Disponible</option>
                                </select>
                            </div>
                        </div> <!-- /form-group-->	
                    </div>         	        
                    <!-- /edit brand result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les modifications</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- remove brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Fournisseur</h4>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer l'élément ?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->

<script src="custom/js/fournisseur.js"></script>

<?php require_once 'includes/footer.php'; ?>
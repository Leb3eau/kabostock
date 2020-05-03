<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php"> Accueil </a></li>		  
            <li class="active">Gestion des clients </li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion des fichiers Clients</div>
            </div>
            <div class="panel-body">

                <div class="remove-messages"></div>


                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel" id="addProductModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Un Fichier Client </button>
                </div>				
                <?php if (isset($_GET['clt'])) { ?>
                <input type="hidden" id="clt" value="<?php echo $_GET['clt'] ?>" />
                    <table class="table" id="manageBrandTable1">
                        <thead>
                            <tr>							
                                <th>Nom Fichier</th>
                                <th>Fichier</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                    </table>
                <?php }else{ ?>
                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>							
                            <th>Client</th>
                            <th>Fichiers</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <?php } ?>
                <!-- /table -->
            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createGClt.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Fichier </h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>


                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom & Prénoms Client : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" placeholder="Ex :  Lebeau Henri Baudouin">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom du fichier : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_fichier" name="nom_fichier" placeholder="Le nom du fichier" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="personnelImage" class="col-sm-3 control-label">Pièces Jointes: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                            <div class="kv-avatar center-block">					        
                                <input type="file" multiple="" class="form-control" id="pjImage" name="pjImage[]" class="file-loading"/>
                            </div>
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


<div class="modal fade" id="ajouterFichier" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitFicForm" action="php_action/createFic.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Fichier pour <i id="nfic"></i></h4>
                </div>
                <div class="modal-body">

                    <div id="add-Fic-messages"></div>
                             	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom du fichier : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_fichier1" name="nom_fichier1" placeholder="Le nom du fichier" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="personnelImage" class="col-sm-3 control-label">Pièces Jointes: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                            <div class="kv-avatar center-block">					        
                                <input type="file" multiple="" class="form-control" id="pjFic" name="pjFic[]" class="file-loading"/>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeclt">Fermer</button>

                    <button type="submit" class="btn btn-primary" id="createficBtn" data-loading-text="Loading..." autocomplete="off">Enregistrer</button>
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


<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Fichier</h4>
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

<script langage="javascript">
    $(function () {

    });

</script>

<script src="custom/js/g_client.js"></script>

<?php require_once 'includes/footer.php'; ?>
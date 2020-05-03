<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb" style="width: 105%">
            <li><a href="dashboard.php">Accueil </a></li>		  
            <li class="active">Produit</li>
        </ol>

        <div class="panel panel-default" style="width: 105%">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion Produits</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-left" style="">
                    <a target="_blank" class="btn btn-default button1" href="listes/imprimer.php?t=produits"> <i class="glyphicon glyphicon-print"></i> Imprimer </a>
                </div>
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Produit </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageCategoriesTable">
                    <thead>
                        <tr>							
                            <th>Désignation</th>
                            <th>Marque</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add categories -->
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitCategoriesForm" action="php_action/createQualities.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Produit</h4>
                </div>
                <div class="modal-body">

                    <div id="add-categories-messages"></div>

                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Désignation: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="productName" placeholder="Nom du Produit" name="productName" autocomplete="off">
                        </div>
                    </div>        	        
                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Marque: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="marque" placeholder="marque du Produit" name="marque" autocomplete="off">
                        </div>
                    </div>	         	        
                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Type: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="type" placeholder="type du Produit" name="type" autocomplete="off">
                        </div>
                    </div>	         	        

                    <div class="form-group">
                        <label for="desc" class="col-sm-4 control-label">Description: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="desciption" name="desciption" placeholder="La desciption de l'article"></textarea>
                        </div>
                    </div>

                </div>                   
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	     
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editCategoriesForm" action="php_action/editQualities.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Édition de Produit</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-categories-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-categories-result">

                        <div class="form-group">
                            <label for="categoriesName" class="col-sm-4 control-label">Désignation: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="editproductName" placeholder="Nom du Produit" name="productName" autocomplete="off">
                            </div>
                        </div>        	        
                        <div class="form-group">
                            <label for="categoriesName" class="col-sm-4 control-label">Marque: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="editmarque" placeholder="marque du Produit" name="marque" autocomplete="off">
                            </div>
                        </div>	         	        
                        <div class="form-group">
                            <label for="categoriesName" class="col-sm-4 control-label">Type: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="edittype" placeholder="type du Produit" name="type" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="col-sm-4 control-label">Description: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="editdesciption" name="desciption" placeholder="La desciption de l'article"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /edit brand result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editCategoriesFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Appliquer Modifications</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Produit</h4>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet élément ?</p>
            </div>
            <div class="modal-footer removeCategoriesFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/produits.js"></script>

<?php require_once 'includes/footer.php'; ?>
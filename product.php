<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php if (isset($_GET['stock'])) { ?>
    <script langage="javascript">
        var so = true;
    </script>
    <?php
} else {
    //die();
    ?>
    <script langage="javascript">
        var so = false;

    </script>
    <?php
}
?>
<script langage="javascript">
    var sto = "<?= $_GET['stock']; ?>";
</script>

<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Accueil</a></li>		  
            <li class="active">Produits</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion des Produits</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Produit </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageProductTable">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Marque</th>
                            <th>Type</th>
                            <th>PUA/Article</th>							
                            <th>Stock Actuel</th>
                            <th>Fournisseur</th>
                            <th>Type de Paiement</th>
                            <th>Mode de Paiement</th>
                            <th>Statut</th>
                            <th>État Stock</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->
            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Produit</h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="add-product-messages"></div>

                    <table class="table table-responsive" id="productTable">
                        <thead>
                            <tr>			  			
                                <th style="">Désignation</th>
                                <th style="">Quantité</th>		  			
                                <th style="">PUA/Article</th>			  			
                                <th style=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $arrayNumber = 0;
                            for ($x = 1; $x < 2; $x++) {
                                ?>
                                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                    <td style="">
                                        <div class="form-group">
                                            <select class="form-control" id="productName<?php echo $x; ?>" name="productName[]">
                                                <option value="">~~Choisir~~</option>  
                                                <?php
                                                $sql = "SELECT id, designation FROM produits";
                                                $result = $connect->query($sql);
                                                $fours = $result->fetch_all();
                                                foreach ($fours as $value) {
                                                    ?>
                                                    <option value="<?= $value[0]; ?>"><?= $value[1]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td style="padding-left: 5%">			  					
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="quantity<?php echo $x; ?>" placeholder="Quantité" name="quantity[]" autocomplete="off">
                                        </div>
                                    </td>

                                    <td  style="padding-left: 5%">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="ratea<?php echo $x; ?>" placeholder="Prix d'achat unitaire" name="ratea[]" autocomplete="off">
                                        </div>
                                    </td>                             
                                    <td>                             
                                        <div class="col-sm-1" style="">
                                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $arrayNumber++;
                            } // /for
                            ?>
                        </tbody>			  	
                    </table>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default btn-xs" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus"></i></button>
                    </div>


                    <div class="form-group">
                        <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="paymentType" id="paymentType">
                                <option value="">~~Choisir~~</option>
                                <option value="1">Chèque</option>
                                <option value="2">Cash</option>
                                <option value="3">Virement</option>
                            </select>
                        </div>
                    </div> <!--/form-group-->							  
                    <div class="form-group">
                        <label for="clientContact" class="col-sm-3 control-label">Mode de paiement</label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="paymentMode" id="paymentStatus">
                                <option value="">~~Choisir~~</option>
                                <option value="1">Full Payment</option>
                                <option value="2">Acompte (Versement)</option>
                                <option value="3">Crédit</option>
                            </select>
                        </div>
                    </div> <!--/form-group-->

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Fournisseur: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="brandName" name="brandName">
                                <option value="">~~Choisir~~</option>  
                                <?php
                                $sql = "SELECT four_id, four_name FROM fournisseurs WHERE four_status = 1 AND four_active = 1";
                                $result = $connect->query($sql);
                                $fours = $result->fetch_all();
                                foreach ($fours as $value) {
                                    ?>
                                    <option value="<?= $value[0] ?>"><?= $value[1] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="DateLivraison" class="col-sm-3 control-label">Livraison: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">                            					        
                            <input type="date" class="form-control" id="datelivraison" name="datelivraison"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bonlivraison" class="col-sm-3 control-label">Pièces Jointes: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                            <div class="kv-avatar center-block">					        
                                <input type="file" class="form-control" id="bonLivraison" name="bonLivraison" class="file-loading"/>
                            </div>
                        </div>
                    </div>
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer </button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	     
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->

<!-- edit categories brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edition Produit</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Chargement...</span>
                </div>

                <div class="div-result">
                    <form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">				    
                        <br />
                        <div id="edit-product-messages"></div>

                        <div class="form-group">
                            <label for="productName" class="col-sm-3 control-label">Désignation: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editproductName" name="productName" onchange="getProduitData('edit')">
                                    <option value="">~~Choisir~~</option>  
                                    <?php
                                    $sql = "SELECT id, designation FROM produits";
                                    $result = $connect->query($sql);
                                    $fours = $result->fetch_all();
                                    foreach ($fours as $value) {
                                        ?>
                                        <option value="<?= $value[0]; ?>"><?= $value[1]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="quantity" class="col-sm-3 control-label">Quantité : </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editquantity" placeholder="Quantité" name="quantity" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ratea" class="col-sm-3 control-label">PUA/Article : </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editratea" placeholder="Prix d'achat unitaire" name="ratea" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="paymentType" id="editpaymentType">
                                    <option value="">~~Choisir~~</option>
                                    <option value="1">Chèque</option>
                                    <option value="2">Cash</option>
                                    <option value="3">Virement</option>
                                </select>
                            </div>
                        </div> <!--/form-group-->							  
                        <div class="form-group">
                            <label for="clientContact" class="col-sm-3 control-label">Mode de paiement</label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="paymentMode" id="editpaymentStatus">
                                    <option value="">~~Choisir~~</option>
                                    <option value="1">Full Payment</option>
                                    <option value="2">Acompte (Versement)</option>
                                    <option value="3">Crédit</option>
                                </select>
                            </div>
                        </div> <!--/form-group-->


                        <div class="form-group">
                            <label for="brandName" class="col-sm-3 control-label">Fournisseur: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editbrandName" name="brandName">
                                    <option value="">~~Choisir~~</option>  
                                    <?php
                                    $sql = "SELECT four_id, four_name FROM fournisseurs WHERE four_status = 1 AND four_active = 1";
                                    $result = $connect->query($sql);
                                    $fours = $result->fetch_all();
                                    foreach ($fours as $value) {
                                        ?>
                                        <option value="<?= $value[0] ?>"><?= $value[1] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="DateLivraison" class="col-sm-3 control-label">Livraison: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">                            					        
                                <input type="date" class="form-control" id="editdatelivraison" name="datelivraison"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editProductStatus" class="col-sm-3 control-label">Statut: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editProductStatus" name="editProductStatus">
                                    <option value="">~~Choisir~~</option>
                                    <option value="1">Disponible</option>
                                    <option value="2">Non Disponible</option>
                                </select>
                            </div>
                        </div> <!-- /form-group-->	         	        

                        <div class="modal-footer editProductFooter">
                            <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                            <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Appliquer Modifications</button>
                        </div> <!-- /modal-footer -->	

                    </form> <!-- /.form -->				     	
                </div>    

            </div> <!-- /modal-body -->

        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Produit</h4>
            </div>
            <div class="modal-body">

                <div class="removeProductMessages"></div>

                <p>Voulez-vous vraiment supprimer cet élément ?</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>
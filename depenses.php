<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Accueil </a></li>		  
            <li><a href="#">Gestion Dépenses</a></li>
            <li class="active">Dépenses</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion Dépenses</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-left" style="">
                    <button class="btn btn-default button1" data-toggle="modal" id="RechModalBtn" data-target="#rechercherModel"> <i class="glyphicon glyphicon-search"></i> Rechercher </button>
                </div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Dépenses </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageCategoriesTable">
                    <thead>
                        <tr>							
                            <th>Date</th>
                            <th>Type</th>
                            <th>Libellé</th>
                            <th>Montant</th>
                            <th style="width:15%;">Options</th>
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

            <form class="form-horizontal" id="submitCategoriesForm" action="php_action/createDepenses.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Dépenses</h4>
                </div>
                <div class="modal-body">

                    <div id="add-categories-messages"></div>

                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Date : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="dateDepenses" name="dateDepenses" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="categoriesStatus" class="col-sm-4 control-label">Type Dépense: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="typeDepenses" placeholder="Type de la dépense" name="typeDepenses" autocomplete="off">
                                <option value="">~~Choisir le type de dépenses~~</option>
                                <option value="Facture">Facture</option>
                                <option value="Personnel">Personnel</option>
                                <option value="Loyer">Loyer</option>
                                <option value="Achat Produits">Achat Produits</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group" id="typePersonnel">
                        <label for="categoriesStatus" class="col-sm-4 control-label">Liste personnel: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="laPersonne" placeholder="Type de la dépense" autocomplete="off">
                                <option value="">~~Choisir le personnel~~</option>
                                <?php
                                $productSql = "SELECT * FROM personnels WHERE status = 1";
                                $productData = $connect->query($productSql);
                                while ($row = $productData->fetch_array()) {
                                    echo "<option value='" . $row[0] . "' salaire='" . $row[7] . "'>" . $row[1] . "</option>";
                                } // /while 
                                ?>
                            </select>
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group" id="autreType">
                        <label for="categoriesStatus" class="col-sm-4 control-label">Autre type: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="AutretypeDepenses" placeholder="Type de depenses" name="AutretypeDepenses" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="categoriesStatus" class="col-sm-4 control-label">Libellé: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="libDepenses" placeholder="Intitulé de la dépense" name="libDepenses" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="categoriesStatus" class="col-sm-4 control-label">Montant: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="montant de la dépense" id="montantDepenses" name="montantDepenses" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	     
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- add categories -->
<div class="modal fade" id="rechercherModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitRechForm" action="php_action/getDepenses.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-check"></i> Rapport des dépenses</h4>
                </div>
                <div class="modal-body">

                    <div id="rech-messages"></div>

                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Date debut: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="datedebut" name="datedebut" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoriesName" class="col-sm-4 control-label">Date fin: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="datefin" name="datefin" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="fermerClose" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>

                    <button type="submit" class="btn btn-primary" id="apercuDepenses" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Aperçu</button>
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

            <form class="form-horizontal" id="editCategoriesForm" action="php_action/editDepenses.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Édition de Dépenses</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-categories-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-categories-result">
                        <div class="form-group">
                            <label for="editCategoriesName" class="col-sm-4 control-label">Date: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" id="editDateDepenses" name="editDateDepenses" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="categoriesStatus" class="col-sm-4 control-label">Type Dépense: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="edittypeDepenses" placeholder="Type de la dépense" name="edittypeDepenses" autocomplete="off">
                                    <option value="">~~Choisir le type de dépenses~~</option>
                                    <option value="Facture">Facture</option>
                                    <option value="Personnel">Personnel</option>
                                    <option value="Loyer">Loyer</option>
                                    <option value="Achat Produits">Achat Produits</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div> <!-- /form-group-->	
                        <div class="form-group" id="editautreType">
                            <label for="categoriesStatus" class="col-sm-4 control-label">Autre type: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="editAutretypeDepenses" placeholder="Type de depenses" name="editAutretypeDepenses" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="categoriesStatus" class="col-sm-4 control-label">Libellé: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="editLibDepenses" name="editLibDepenses" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->	         	        
                        <div class="form-group">
                            <label for="categoriesStatus" class="col-sm-4 control-label">Montant: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="editMontantDepenses" name="editMontantDepenses" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->	 
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
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Dépenses</h4>
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


<script src="custom/js/restau_depenses.js"></script>
<script>
    $(function () {

        $("#typePersonnel").hide();
        $("#autreType").hide();
        $("#editautreType").hide();

        $("#edittypeDepenses").change(function () {
            if ($(this).val() == "Autre") {
                $("#editautreType").show(500);
            } else {
                $("#editautreType").hide();
            }
        });

        $("#typeDepenses").change(function () {
            if ($(this).val() == "Autre") {
                $("#autreType").show(500);
            } else {
                $("#autreType").hide();
            }
            
            if ($(this).val() == "Personnel") {
                $("#typePersonnel").show(500);
            } else {
                $("#typePersonnel").hide();
            }
        });
        
        $("#laPersonne").change(function () {
             var mont = $(this).children("option:selected").attr("salaire");
             $("#libDepenses").val("Salaire "+$(this).children("option:selected").text());
             $("#montantDepenses").val(mont);
        });

        // on click on submit categories form modal
        $('#RechModalBtn').unbind('click').bind('click', function () {
            // reset the form text
            $("#submitRechForm")[0].reset();
            // remove the error text
            $(".text-danger").remove();
            // remove the form error
            $('.form-group').removeClass('has-error').removeClass('has-success');

            // submit categories form function
            $("#submitRechForm").unbind('submit').bind('submit', function () {

                var startDate = $("#datedebut").val();
                var endDate = $("#datefin").val();

                if (startDate == "" || endDate == "") {
                    if (startDate == "") {
                        $("#datedebut").closest('.form-group').addClass('has-error');
                        $("#datedebut").after('<p class="text-danger">Ce champ est requis !</p>');
                    } else {
                        $(".form-group").removeClass('has-error');
                        $(".text-danger").remove();
                    }

                    if (endDate == "") {
                        $("#datefin").closest('.form-group').addClass('has-error');
                        $("#datefin").after('<p class="text-danger">Ce champ est requis !</p>');
                    } else {
                        $(".form-group").removeClass('has-error');
                        $(".text-danger").remove();
                    }
                } else {
                    $(".form-group").removeClass('has-error');
                    $(".text-danger").remove();

                    var form = $(this);

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'text',
                        success: function (response) {
                            var mywindow = window.open('', 'Apercu des depenses', 'height=400,width=600');
                            mywindow.document.write('<html><head><title>LISTE DÉPENSES</title>');
                            mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                            mywindow.document.write('</head><body>');
                            mywindow.document.write(response);
                            mywindow.document.write('</body></html>');

                            mywindow.document.close(); // necessary for IE >= 10
                            mywindow.focus(); // necessary for IE >= 10  

                            $("#submitRechForm")[0].reset();
                            // remove the error text
                            $(".text-danger").remove();
                            // remove the form error
                            $('.form-group').removeClass('has-error').removeClass('has-success');
                            $('#fermerClose').click();
                        } // /success
                    });	// /ajax

                } // /else

                return false;
            }); // submit categories form function
        }); // /on click on submit categories form modal	

    });
</script>

<?php require_once 'includes/footer.php'; ?>
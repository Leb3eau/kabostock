<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php"> Accueil </a></li>		  
            <li class="active">Gestion des RDV </li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion de Rendez-Vous</div>
            </div>
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-left" style="">
                    <button class="btn btn-default button1" data-toggle="modal" id="RechModalBtn" data-target="#rechercherModel"> <i class="glyphicon glyphicon-search"></i> Rechercher </button>
                </div>			
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel" id="addProductModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Un RDV </button>
                </div>				

                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>							
                            <th>Client</th>
                            <th>Contact</th>
                            <th>Description</th>
                            <th>Lieu</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>État</th>
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

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createRdv.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter rendez-Vous </h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Client : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="clt" name="clt" placeholder="Nom & Prenoms du client" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Contact : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="contact" placeholder="Le contact" name="contact" autocomplete="off">
                        </div>
                    </div> <!-- /form-group--> 
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Description : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="desc" name="desc" placeholder="Le libellé du rdv" autocomplete="off"></textarea>
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Lieu : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Ex :  Lieu de tenue du rdv" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Date : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="daterdv" placeholder="La date du rdv" name="daterdv" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Heure : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="heure" placeholder="Heure du Rdv" name="heure" autocomplete="off">
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


<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Rendez-vous</h4>
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

<div class="modal fade" tabindex="-1" role="dialog" id="terminerBrandModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-ok-sign"></i> Terminer Rendez-vous</h4>
            </div>
            <div class="modal-body">
                <p> Ce Rensez-vous a été effectif ?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="terBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Confirmer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->

<!-- add categories -->
<div class="modal fade" id="rechercherModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitRechForm" action="php_action/getRDVlListe.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-check"></i> Rapport des rdv</h4>
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
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editCategoriesForm" action="php_action/editRdv.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Édition de Rendez-vous </h4>
                </div>
                <div class="modal-body">

                    <div id="edit-categories-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-categories-result">
                       
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Client : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editclt" name="clt" placeholder="Nom & Prenoms du client" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Contact : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editcontact" placeholder="Le contact" name="contact" autocomplete="off">
                        </div>
                    </div> <!-- /form-group--> 
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Description : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="editdesc" name="desc" placeholder="Le libellé du rdv" autocomplete="off"></textarea>
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Lieu : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editlieu" name="lieu" placeholder="Ex :  Lieu de tenue du rdv" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Date : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="editdaterdv" placeholder="La date du rdv" name="daterdv" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Heure : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="editheure" placeholder="Heure du Rdv" name="heure" autocomplete="off">
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


<!--reporter -->
<div class="modal fade" tabindex="-1" role="dialog" id="reporterBrandModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Reporter le rendez-vous</h4>
            </div>      

            <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                <div class="paymentOrderMessages"></div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due" class="col-sm-3 control-label">Date actuelle</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="date_actu" name="total" disabled="true" />					
                            </div>
                        </div> <!--/form-group-->		
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due" class="col-sm-3 control-label">Heure actuelle</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="heure_actu" name="due" disabled="true" />					
                            </div>
                        </div><!--/form-group-->	
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payAmount" class="col-sm-3 control-label">Nouvelle date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="newDate" name="newDate"/>					      
                            </div>
                        </div> <!--/form-group-->
                    </div>
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="payAmount" class="col-sm-3 control-label">Nouvelle heure</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="newHeure" name="newHeure"/>					      
                            </div>
                        </div> <!--/form-group-->                							  				  
                    </div> <!--/form-group-->                							  				  
                </div> <!--/form-group-->                							  				  

            </div> <!--/modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeFermer1"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les Modifications</button>	
            </div>           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="custom/js/rdv.js"></script>


<script>
    $(function () {
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
                            var mywindow = window.open('', 'Apercu du Personnel', 'height=400,width=600');
                            mywindow.document.write('<html><head><title>LISTE DU PERSONNEL</title>');
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
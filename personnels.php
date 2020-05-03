<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php"> Accueil </a></li>		  
            <li class="active">Gestion du Personnel </li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion du personnel</div>
            </div>
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-left" style="">
                    <button class="btn btn-default button1" data-toggle="modal" id="RechModalBtn" data-target="#rechercherModel"> <i class="glyphicon glyphicon-search"></i> Rechercher </button>
                </div>			
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel" id="addProductModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Un Personnel </button>
                </div>				

                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>							
                            <th style="width:10%;">Image</th>
                            <th>Nom & Prénoms</th>
                            <th>CNI</th>
                            <th>Contact</th>
                            <th>Fonction</th>
                            <th>Date fonction</th>
                            <th>Salaire</th>
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

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createPersonnel.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter Personnel </h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="personnelImage" class="col-sm-3 control-label">Photo: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                            <div class="kv-avatar center-block">					        
                                <input type="file" class="form-control" id="personnelImage" name="personnelImage" class="file-loading"/>
                            </div>
                        </div>
                    </div> <!-- /form-group-->	 

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom & Prénoms : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" placeholder="Ex :  Lebeau Henri Baudouin" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">CNI : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="cni" name="cni" placeholder="Le numero CNI" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Fonction : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fonctionPersonnel" name="fonctionPersonnel" placeholder="Ex :  Réceptionniste" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="ContactFour" class="col-sm-3 control-label">Date Fonction : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="dateFonction" placeholder="La date d'entrer en fonction" name="dateFonction" autocomplete="off">
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
                        <label for="ContactFour" class="col-sm-3 control-label">Salaire : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control number-separator" id="salaire" placeholder="Le salaire" name="salaire" autocomplete="off">
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

<!-- edit categories brand -->
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Modifications de Personnel</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="div-result">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                        <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Informations Personnelles</a></li>    
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">


                        <div role="tabpanel" class="tab-pane active" id="photo">
                            <form action="php_action/editPersoImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

                                <br />
                                <div id="edit-productPhoto-messages"></div>

                                <div class="form-group">
                                    <label for="editProductImage" class="col-sm-3 control-label">Photo du Personnel: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">							    				   
                                        <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                                    </div>
                                </div> <!-- /form-group-->	     	           	       

                                <div class="form-group">
                                    <label for="editProductImage" class="col-sm-3 control-label">Choisir Photo: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <!-- the avatar markup -->
                                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                                        <div class="kv-avatar center-block">					        
                                            <input type="file" class="form-control" id="editProductImage" name="editProductImage" class="file-loading" style="width:auto;"/>
                                        </div>

                                    </div>
                                </div> <!-- /form-group-->	     	           	       

                                <div class="modal-footer editProductPhotoFooter">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                                    <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> 
                                </div>
                                <!-- /modal-footer -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- product image -->
                        <div role="tabpanel" class="tab-pane" id="productInfo">
                            <form class="form-horizontal" id="editBrandForm" action="php_action/editPersonnel.php" method="POST">
                                <br />

                                <div id="edit-brand-messages"></div>

                                <div class="form-group">
                                    <label for="brandName" class="col-sm-3 control-label">Nom & Prénoms : </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editnom_prenom" name="nom_prenom" placeholder="Ex :  Lebeau Henri Baudouin" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->	         	        
                                <div class="form-group">
                                    <label for="brandName" class="col-sm-3 control-label">CNI : </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editcni" name="cni" placeholder="Le numero CNI" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->	         	        
                                <div class="form-group">
                                    <label for="brandName" class="col-sm-3 control-label">Fonction : </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editfonctionPersonnel" name="fonctionPersonnel" placeholder="Ex :  Réceptionniste" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->	         	        
                                <div class="form-group">
                                    <label for="ContactFour" class="col-sm-3 control-label">Date Fonction : </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="editdateFonction" placeholder="La date d'entrer en fonction" name="dateFonction" autocomplete="off">
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
                                    <label for="ContactFour" class="col-sm-3 control-label">Salaire : </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editsalaire" placeholder="Le salaire" name="salaire" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->    

                                <div class="modal-footer editPersoFooter">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                                    <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les modifications</button>
                                </div>			     
                            </form> <!-- /.form -->				     	
                        </div>    
                        <!-- /product info -->
                    </div>

                </div>

            </div> <!-- /modal-body -->


        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Personnel</h4>
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

<!-- add categories -->
<div class="modal fade" id="rechercherModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitRechForm" action="php_action/getPersonnelListe.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-check"></i> Rapport du personnel</h4>
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


<script src="custom/js/personnel.js"></script>


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
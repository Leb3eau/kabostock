<?php require_once 'includes/header.php'; ?>

<?php
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
?>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Accueil</a></li>		  
            <li class="active">Paramètres</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Mes Paramètres</div>
            </div> <!-- /panel-heading -->

            <div class="panel-body">

                <div class="div-action pull pull-right" style="padding-bottom:20px; margin-top: -1%">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Un Utilisateur </button>
                </div> <!-- /div-action -->

                <form action="php_action/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
                    <fieldset>
                        <legend>Changer le nom Utilisateur</legend>

                        <div class="changeUsenrameMessages"></div>			

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Utilisateur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" value="<?php echo $result['username']; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" /> 
                                <button type="submit" class="btn btn-success" data-loading-text="Chargement..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les modifications </button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <form action="php_action/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
                    <fieldset>
                        <legend>Changer le mot de passe</legend>

                        <div class="changePasswordMessages"></div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Mot de passe actuel</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Actuel mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="npassword" class="col-sm-2 control-label">Nouveau Mot de passe</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="npassword" name="npassword" placeholder="Nouveau Mot de Passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cpassword" class="col-sm-2 control-label">Confirmer Mot Passe</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Saisir le mot de passe à nouveau">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" /> 
                                <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Enregistrer les modifications </button>

                            </div>
                        </div>
                    </fieldset>
                </form>

            </div> <!-- /panel-body -->		

        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->	
</div> <!-- /row-->


<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createUser.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un Utilisateur </h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom & Prénoms : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" placeholder="Le nom Complet de l'utilisateur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Nom utilisateur : </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="cretaeusername" name="cretaeusername" placeholder="Le nom utilisateur" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="pass" class="col-sm-3 control-label">Mot de Passe: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="motpass" placeholder="Mot de passe" name="motpass" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->		         	        
                    <div class="form-group">
                        <label for="cpass" class="col-sm-3 control-label">Confirmation mot de passe: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="cpass" placeholder="ressaisir le mot de passe" name="cpass" autocomplete="off">
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Rôle: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control" id="role">
                                <option value="">~~Choisir~~</option>
                                <option value="admin">Administrateur</option>
                                <option value="user">Utilisateur Standard</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">E-mail: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="txtmail" placeholder="Saisir votre E-mail" name="txtmail" autocomplete="off">
                        </div>
                    </div>
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
 



<script src="custom/js/setting.js"></script>
<script src="custom/js/add.js"></script>
<?php require_once 'includes/footer.php'; ?>
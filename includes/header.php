<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>DIGI CORP - Gestion de Stock</title>
        <meta charset="utf-8" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
        <link rel="shortcut icon" href="assests/images/logo1.png" type="image/x-icon">
        <!-- bootstrap theme-->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

        <link rel="stylesheet" href="custom/css/custom.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

        <!-- file input -->
        <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

        <!-- jquery -->
        <script src="assests/jquery/jquery.min.js"></script>
        <!-- jquery ui -->  
        <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
        <script src="assests/jquery-ui/jquery-ui.min.js"></script>
        <!-- bootstrap js -->
        <script src="assests/bootstrap/js/bootstrap.min.js"></script>
        <script src="assests/plugins/notify/notify.min.js" type="text/javascript"></script>
        <script src="custom/js/verifrdv.js"></script>
        <!--<script src="custom/js/easy-number-separator.js"></script>-->
    </head>

    <body style="background: url(assests/images/background.png); background-position: 50% 50%; background-size: 60% auto ;">


        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#">Brand</a> -->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

                    <?php if ($_SESSION['userRole'] === "admin") { ?>

                        <ul class="nav navbar-nav navbar-right">

                            <li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Accueil</a></li>        

                            <li id="navQualities"><a href="produits.php"> <i class="glyphicon glyphicon-stats"></i> Produits</a></li> 

                            <li class="dropdown" id="navGestionStock">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-exchange" style="font-weight: bold; font-size: 1.2em"></i> Gestion stocks<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="navBrand"><a href="provider.php"><i class="glyphicon glyphicon-btc"></i>  Fournisseurs</a></li>
                                    <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Achats Produits </a></li>     
                                    <li id="navStocks"><a href="gesTock.php"> <i class="glyphicon glyphicon-share"></i> Gestion des stocks</a></li>           

                                </ul>
                            </li>
                            <li class="dropdown" id="navOrders">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Ventes<span class="caret"></span></a>
                                <ul class="dropdown-menu">            
                                    <li id="topNavAddOrders"><a href="orders.php?o=add"><i class="glyphicon glyphicon-plus"></i> Ajouter Vente</a></li>
                                    <li id="topNavManageOrders"><a href="orders.php?o=manord"><i class="glyphicon glyphicon-edit"></i> Gestion Vente</a></li>            
                                    <li id="topNavDevis"><a href="devis.php?o=manord"> <i class="fa fa-newspaper-o"></i> Factures Pro-Forma</a></li>           
                                </ul>
                            </li>      
                            <li class="dropdown" id="navBil">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-usd"></i> Comptabilité<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="topNavbil"><a href="bilan.php"> <i class="glyphicon glyphicon-check"></i> Bilan des ventes</a></li>
                                    <li id="topNavDep"><a href="depenses.php"> <i class="glyphicon glyphicon-check"></i> Gestion Depenses</a></li>            
                                    <li id="topNavBenFour"><a href="four.php"> <i class="glyphicon glyphicon-list"></i> Factures d'achat-paiement fournisseur</a></li>                                           
                                    <li id="topNavListeAchat"><a href="benefice.php"> <i class="glyphicon glyphicon-list-alt"></i> Bénéfices</a></li>
                                </ul>
                            </li>

                            <li id="navPersonnel"><a href="personnels.php"> <i class="glyphicon glyphicon-ruble"></i> Gestion Personnels </a></li>     

                            <li id="navRDV"><a href="rdv.php"> <i class="glyphicon glyphicon-calendar"></i> Gestion RDV </a></li>     

                            <li id="navG_Client"><a href="g_clients.php"> <i class="glyphicon glyphicon-bookmark"></i> Gestion Clients </a></li>     

                            <li class="dropdown" id="navSetting">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu">            
                                    <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configurations</a></li>            
                                    <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Déconnexion</a></li>            
                                </ul>
                            </li>
                        </ul>
                    <?php } else if ($_SESSION['userRole'] === "user") {
                        ?>
                        <ul class="nav navbar-nav navbar-right">

                            <li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Accueil</a></li>        

                            <li id="navQualities"><a href="produits.php"> <i class="glyphicon glyphicon-stats"></i> Produits</a></li> 

                            <li class="dropdown" id="navGestionStock">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-exchange" style="font-weight: bold; font-size: 1.2em"></i> Gestion stocks<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="navBrand"><a href="provider.php"><i class="glyphicon glyphicon-btc"></i>  Fournisseurs</a></li>
                                    <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Achats Produits </a></li>
                                </ul>
                            </li>
                            <li class="dropdown" id="navOrders">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Ventes<span class="caret"></span></a>
                                <ul class="dropdown-menu">            
                                    <li id="topNavAddOrders"><a href="orders.php?o=add"><i class="glyphicon glyphicon-plus"></i> Ajouter Vente</a></li>
                                    <li id="topNavManageOrders"><a href="orders.php?o=manord"><i class="glyphicon glyphicon-edit"></i> Gestion Vente</a></li>            
                                    <li id="topNavDevis"><a href="devis.php?o=manord"> <i class="fa fa-newspaper-o"></i> Factures Pro-Forma</a></li>           
                                </ul>
                            </li>      
                            <li class="dropdown" id="navBil">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-usd"></i> Comptabilité<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="topNavDep"><a href="depenses.php"> <i class="glyphicon glyphicon-check"></i> Gestion Depenses</a></li>            
                                </ul>
                            </li>
                            
                            <li id="navRDV"><a href="rdv.php"> <i class="glyphicon glyphicon-calendar"></i> Gestion RDV </a></li>     

                            <li id="navG_Client"><a href="g_clients.php"> <i class="glyphicon glyphicon-bookmark"></i> Gestion Clients </a></li>     

                            <li class="dropdown" id="navSetting">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu">            
                                    <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Déconnexion</a></li>            
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
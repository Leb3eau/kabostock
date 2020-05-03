<?php
require_once 'php_action/db_connect.php';
require_once 'includes/header.php';

if ($_GET['o'] == 'add') {
// add order
    echo "<div class='div-request div-hide'>add</div>";
} else if ($_GET['o'] == 'manord') {
    echo "<div class='div-request div-hide'>manord</div>";
} else if ($_GET['o'] == 'editOrd') {
    echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order
?>

<ol class="breadcrumb">
    <li><a href="dashboard.php">Accueil</a></li>
    <li>Devis</li>
    <li class="active">
        <?php if ($_GET['o'] == 'add') { ?>
            Ajout_Devis
        <?php } else if ($_GET['o'] == 'manord') { ?>
            Gestion_Devis
        <?php } // /else manage order ?>
    </li>
</ol>


<h4>
    <i class='glyphicon glyphicon-circle-arrow-right'></i>
    <?php
    if ($_GET['o'] == 'add') {
        echo "AJOUT DE DEVIS";
    } else if ($_GET['o'] == 'manord') {
        echo "GESTION DE DEVIS";
    } else if ($_GET['o'] == 'editOrd') {
        echo "ÉDITION DE DEVIS";
    }
    ?>	
</h4>



<div class="panel panel-default">
    <div class="panel-heading">

        <?php if ($_GET['o'] == 'add') { ?>
            <i class="glyphicon glyphicon-plus-sign"></i> Ajout de devis
        <?php } else if ($_GET['o'] == 'manord') { ?>
            <i class="glyphicon glyphicon-edit"></i> Gestion de devis
        <?php } else if ($_GET['o'] == 'editOrd') { ?>
            <i class="glyphicon glyphicon-edit"></i> Édition de devis
        <?php } ?>

    </div> <!--/panel-->	
    <div class="panel-body">

        <?php
        if ($_GET['o'] == 'add') {
            // add order
            ?>			

            <div class="success-messages"></div> <!--/success-messages-->

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <hr style="border: 1px solid skyblue">
                </div>
                <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-info" style="width: 100%"> Informations du client </label></div>
                <div class="col-md-4">
                    <hr style="border: 1px solid skyblue">
                </div>
            </div>
            <hr>

            <form class="form-horizontal" method="POST" action="php_action/createDevis.php" id="createOrderForm">

                <div class="form-group">
                    <label for="orderDate" class="col-sm-2 control-label">Date devis<i class="text-danger">*</i></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientName" class="col-sm-2 control-label">Nom du Client</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-2 control-label">Contacts Client</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
                    </div>
                </div> <!--/form-group-->			  
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: 1px solid #ff9900">
                    </div>
                    <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-warning" style="width: 111%">Informations sur les articles </label></div>
                    <div class="col-md-4">
                        <hr style="border: 1px solid #ff9900">
                    </div>
                </div>
                <hr>

                <table class="table table-responsive" id="productTable">
                    <thead>
                        <tr>			  			
                            <th style="width: 20%">Produit</th>
                            <th style="">Prix d'achat</th>
                            <th style="">Prix de vente</th>
                            <th style="">Quantité</th>		  			
                            <th style="">Total</th>			  			
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
                                        <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                                            <option value="">~~Choisir~~</option>
                                            <?php
                                            $productSql = "SELECT product.product_id, produits.designation FROM product, produits WHERE product.active = 1 AND product.status = 1 AND product.quantity != 0 AND product.produit_id=produits.id";
                                            $productData = $connect->query($productSql);
                                            while ($row = $productData->fetch_array()) {
                                                echo "<option value='" . $row[0] . "' id='changeProduct" . $row[0] . "'>" . $row[1] . "</option>";
                                            } // /while 
                                            ?>
                                        </select>
                                    </div>
                                </td>

                                <td style="padding-left: 1em">			  					
                                    <input type="text" name="ratea[]" id="ratea<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
                                    <input type="hidden" name="rateaValue[]" id="rateaValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>

                                <td style="">
                                    <div class="form-group" style="padding-left: 1em">
                                        <input type="text" name="ratev[]" id="ratev<?php echo $x; ?>" autocomplete="off" class="form-control" onchange="getTotal(<?php echo $x ?>)" onkeyup="getTotal(<?php echo $x ?>)"/>			  					
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-group" style="padding-left: 1.5em">
                                        <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onchange="getTotal(<?php echo $x ?>)" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                                    </div>
                                </td>

                                <td style="padding-left: 12px">			  					
                                    <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
                                    <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td>

                                    <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                            $arrayNumber++;
                        } // /for
                        ?>
                    </tbody>			  	
                </table>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter une ligne </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: 1px solid red">
                    </div>
                    <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-danger" style="width: 100%"> Résumé de la commande </label></div>
                    <div class="col-md-4">
                        <hr style="border: 1px solid red">
                    </div>
                </div>
                <hr>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subTotal" class="col-sm-3 control-label">Montant HT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                            <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                        </div>
                    </div> <!--/form-group-->			  

                </div> <!--/form-group-->                    			  

                <div class="col-md-6">   

                    <div class="form-group">
                        <label for="vat" class="col-sm-3 control-label">TVA (18%)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                            <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                        </div>
                    </div> <!--/form-group-->                     			  
                </div> <!--/col-md-6-->
                <div class="col-md-2">

                </div> <!--/col-md-2-->
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="totalAmount" class="col-sm-3 control-label">Montant Total</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
                            <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                        </div>
                    </div> <!--/form-group-->			  
                </div> <!--/col-md-6-->
                <div class="col-md-2">

                </div> <!--/col-md-2-->

                <div class="form-group submitButtonFooter">
                    <div class="col-sm-offset-2 col-sm-10 text-center">                        
                        <hr style="border: 1px solid skyblue; margin-left: -15%;">                
                    </div>
                    <div class="row">                        
                        <div class="col-md-5 text-right">                        
                            <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class=" btn-lg btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                        </div>
                        <div class="col-md-2 text-center">                        
                        </div>
                        <div class="col-md-5 text-left">                        
                            <button type="reset" id="reset" class="btn btn-default btn-lg" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Réinitialiser</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } else if ($_GET['o'] == 'manord') {
            // manage order
            ?>

            <div id="success-messages"></div>

            <div class="div-action pull pull-right" style="padding-bottom:20px;">
                <a href="devis.php?o=add"><button class="btn btn-default button1"> <i class="glyphicon glyphicon-plus-sign"></i> Faire Devis </button></a> 
            </div>

            <table class="table" id="manageOrderTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Devis</th>
                        <th>Nom Client</th>
                        <th>Contact</th>
                        <th>Nombre d'articles</th>
                        <th>Montant Total</th>
                        <th>Option</th>
                    </tr>
                </thead>
            </table>

            <?php
            // /else manage order
        } else if ($_GET['o'] == 'editOrd') {
            // get order
            ?>

            <div class="success-messages"></div> <!--/success-messages-->

            <form class="form-horizontal" method="POST" action="php_action/editDevis.php" id="editOrderForm">

                <?php
                $orderId = $_GET['i'];

                $sql = "SELECT devis.devis_id, devis.devis_date, devis.client_name, devis.client_contact, devis.sub_total, devis.vat, devis.total_amount FROM devis 	
					WHERE devis.devis_id = {$orderId}";

                $result = $connect->query($sql);
                $data = $result->fetch_row();
                /* var_dump($data);
                  die(); */
                ?>

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: 1px solid skyblue">
                    </div>
                    <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-info" style="width: 100%"> Informations du client </label></div>
                    <div class="col-md-4">
                        <hr style="border: 1px solid skyblue">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="orderDate" class="col-sm-2 control-label">Date devis<i class="text-danger">*</i></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientName" class="col-sm-2 control-label">Nom du Client</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-2 control-label">Contacts Client</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
                    </div>
                </div> <!--/form-group-->			  
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: 1px solid #ff9900">
                    </div>
                    <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-warning" style="width: 100%"> Articles </label></div>
                    <div class="col-md-4">
                        <hr style="border: 1px solid #ff9900">
                    </div>
                </div>
                <hr>

                <table class="table table-responsive" id="productTable">
                    <thead>
                        <tr>			  			
                            <th style="width: 20%">Produit</th>
                            <th style="">Prix d'achat</th>
                            <th style="">Prix de vente</th>
                            <th style="">Quantité</th>		  			
                            <th style="">Total</th>			  			
                            <th style=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orderItemSql = "SELECT * FROM devis_item WHERE devis_item.devis_id = {$orderId}";
                        $orderItemResult = $connect->query($orderItemSql);
                        $arrayNumber = 0;
                        $x = 1;
                        while ($orderItemData = $orderItemResult->fetch_array()) {
                            ?>
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                <td style="">
                                    <div class="form-group">
                                        <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                                            <option value="">~~Choisir~~</option>
                                            <?php
                                            $productSql = "SELECT product.product_id, produits.designation FROM product, produits WHERE product.active = 1 AND product.status = 1 AND product.quantity != 0 AND product.produit_id=produits.id";
                                            $productData = $connect->query($productSql);
                                            while ($row = $productData->fetch_array()) {
                                                $selected = "";
                                                if ($row['product_id'] == $orderItemData['product_id']) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }

                                                echo "<option value='" . $row['product_id'] . "' id='changeProduct" . $row['product_id'] . "' " . $selected . " >" . $row['designation'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>

                                <td style="padding-left: 1em">			  					
                                    <input value="<?php echo $orderItemData['ratea']; ?>" type="text" name="ratea[]" id="ratea<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
                                    <input value="<?php echo $orderItemData['ratea']; ?>" type="hidden" name="rateaValue[]" id="rateaValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>

                                <td style="">
                                    <div class="form-group" style="padding-left: 1em">
                                        <input value="<?php echo $orderItemData['ratev']; ?>" type="text" name="ratev[]" id="ratev<?php echo $x; ?>" autocomplete="off" class="form-control" onchange="getTotal(<?php echo $x ?>)" onkeyup="getTotal(<?php echo $x ?>)"/>			  					
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-group" style="padding-left: 1.5em">
                                        <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onchange="getTotal(<?php echo $x ?>)" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>"/>
                                    </div>
                                </td>

                                <td style="padding-left: 12px">			  					
                                    <input value="<?php echo $orderItemData['total']; ?>" type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
                                    <input value="<?php echo $orderItemData['total']; ?>" type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td>

                                    <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                            $arrayNumber++;
                        } // /for
                        ?>
                    </tbody>			  	
                </table>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter une ligne </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: 1px solid red">
                    </div>
                    <div class="col-md-4"><label class="text-center text-uppercase btn-lg btn-danger" style="width: 100%"> Résumé de la commande </label></div>
                    <div class="col-md-4">
                        <hr style="border: 1px solid red">
                    </div>
                </div>
                <hr>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subTotal" class="col-sm-3 control-label">Montant HT</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $data[4] ?>" type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                            <input value="<?php echo $data[4] ?>" type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                        </div>
                    </div> <!--/form-group-->                    			  

                </div> <!--/col-md-6-->

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vat" class="col-sm-3 control-label">TVA (18%)</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $data[5] ?>" type="text" class="form-control" id="vat" name="vat" disabled="true" />
                            <input value="<?php echo $data[5] ?>" type="hidden" class="form-control" id="vatValue" name="vatValue" />
                        </div>
                    </div> <!--/form-group-->			  
                </div> <!--/col-md-6-->
                <div class="col-md-2">

                </div> <!--/col-md-6-->
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="totalAmount" class="col-sm-3 control-label">Montant Total</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $data[6] ?>" type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
                            <input value="<?php echo $data[6] ?>" type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                        </div>
                    </div> <!--/form-group-->
                </div> <!--/col-md-6-->
                <div class="col-md-2">

                </div> <!--/col-md-6-->

                <div class="form-group editButtonFooter">
                    <div class="col-sm-offset-2 col-sm-10 text-center">                        
                        <hr style="border: 1px solid skyblue; margin-left: -15%;">                
                    </div>
                    <div class="col-sm-offset-5 col-sm-7">
                        <input type="hidden" name="orderId" id="orderId" value="<?php echo $orderId; ?>" />
                        <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn-lg btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Appliquer les Modifications</button>
                    </div>
                </div>
            </form>
        <?php } // /get order else  
        ?>


    </div> <!--/panel-->	
</div> <!--/panel-->	

<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Transfert de devis en Facture</h4>
            </div>      

            <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                <div class="paymentOrderMessages"></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subTotal" class="col-sm-3 control-label">Montant HT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="subTotal1" name="subTotal" disabled="true" />
                            <input type="hidden" class="form-control" id="subTotalValue1" name="subTotalValue" />
                        </div>
                    </div> <!--/form-group-->			  
                    <div class="form-group">
                        <label for="vat" class="col-sm-3 control-label">TVA (18%)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vat1" name="vat" disabled="true" />
                            <input type="hidden" class="form-control" id="vatValue1" name="vatValue" />
                        </div>
                    </div> <!--/form-group-->			  
                    <div class="form-group">
                        <label for="totalAmount" class="col-sm-3 control-label">Montant Total</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="totalAmount1" name="totalAmount" disabled="true"/>
                            <input type="hidden" class="form-control" id="totalAmountValue1" name="totalAmountValue" />
                        </div>
                    </div> <!--/form-group-->			  
                    <div class="form-group">
                        <label for="discount" class="col-sm-3 control-label">Remise</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="discount1" name="discount" onkeyup="discountFun()" autocomplete="off" />
                        </div>
                    </div> <!--/form-group-->	
                    <div class="form-group">
                        <label for="grandTotal" class="col-sm-3 control-label">Montant à Payer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="grandTotal1" name="grandTotal" disabled="true" />
                            <input type="hidden" class="form-control" id="grandTotalValue1" name="grandTotalValue" />
                        </div>
                    </div> <!--/form-group-->			  		  
                </div> <!--/col-md-6-->

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="paid" class="col-sm-3 control-label">Montant Payé</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="paid1" name="paid" autocomplete="off" onkeyup="paidAmount1()" />
                        </div>
                    </div> <!--/form-group-->			  
                    <div class="form-group">
                        <label for="due" class="col-sm-3 control-label">Reste à payer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="due1" name="due" disabled="true" />
                            <input type="hidden" class="form-control" id="dueValue1" name="dueValue" />
                        </div>
                    </div> <!--/form-group-->

                    <div class="form-group">
                        <label for="clientContact" class="col-sm-3 control-label">Type de paiement</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="paymentType" id="paymentType1">
                                <option value="">~~Choisir~~</option>
                                <option value="1">Cheque</option>
                                <option value="2">Cash</option>
                                <option value="3">Virement</option>
                            </select>
                        </div>
                    </div> <!--/form-group-->							  
                    <div class="form-group">
                        <label for="clientContact" class="col-sm-3 control-label">Statut de paiement</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="paymentStatus" id="paymentMode1">
                                <option value="">~~Choisir~~</option>
                                <option value="1">Paiement Complet</option>
                                <option value="2">Acompte (Versement)</option>
                                <option value="3">Crédit</option>
                            </select>
                        </div>
                    </div> <!--/form-group-->							  
                </div> <!--/col-md-6-->


            </div> <!--/modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Transférer En Facture</button>	
            </div>           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Suppression de Commande</h4>
            </div>
            <div class="modal-body">

                <div class="removeOrderMessages"></div>

                <p>Voulez-vous vraiment supprimer ce devis ?</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/devis.js"></script>

<?php require_once 'includes/footer.php'; ?>



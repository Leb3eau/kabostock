<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i> GESTION DES STOCKS
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">
                
                <form class="form-horizontal" action="php_action/getstock.php" method="post" id="getOrderBilanForm">
                    <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Date Debut</label>
                        <div class="col-sm-10">
                            <input id="dateDebut" type="date" class="form-control" name="startDate" placeholder="Date debut"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endDate" class="col-sm-2 control-label">Date Fin</label>
                        <div class="col-sm-10">
                            <input id="dateFin" type="date" class="form-control" name="endDate" placeholder="Date de fin"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" id="generateBilanBtn"> <i class="glyphicon glyphicon-print"></i> Voir le stock</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /panel-body -->
        </div>
    </div>
    <!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/stock.js"></script>

<?php require_once 'includes/footer.php'; ?>
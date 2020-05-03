<?php require_once 'includes/header.php'; ?>

    <input type="hidden" id="dr" value="ben"/>
    
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i>Rapports des Bénéfices
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">
                <form class="form-horizontal" action="php_action/getListeAchat.php" method="post" id="getListeAchat">
                    <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Date Debut</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endDate" class="col-sm-2 control-label">Date Fin</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="generateReportList"> <i class="glyphicon glyphicon-ok-sign"></i> Générer Liste</button>
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

<script src="custom/js/list.js"></script>

<?php require_once 'includes/footer.php'; ?>
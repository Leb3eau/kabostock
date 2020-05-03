<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i> Rapport du Personnel
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">

                <form class="form-horizontal" action="php_action/getPersonnelListe.php" method="post" id="getPersonnelReportForm">
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
                            <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Générer Liste</button>
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

<script src="custom/js/liste_personnel.js"></script>

<?php require_once 'includes/footer.php'; ?>
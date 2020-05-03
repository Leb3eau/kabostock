<?php require_once 'includes/header.php';
include './includes/fonctionsImportantes.php'; ?>

<?php
setlocale(LC_ALL, 'fra_fra');
//setlocale(LC_TIME, 'fr_FR.UTF-8');
//echo strftime('%A %d %B %Y, %H:%M'); // jeudi 11 octobre 2012, 16:03


$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;
$today = date("Y-m-d");

$orderSqle = "SELECT * FROM orders WHERE order_status = 1";
$orderQuerye = $connect->query($orderSqle);
$countOrdere = $orderQuerye->num_rows;

$totalMontant = 0;
while ($orderResultz = $orderQuerye->fetch_assoc()) {
    $totalMontant += $orderResultz['paid'];
}

$orderSql = "SELECT * FROM orders WHERE order_status = 1 AND order_date = '$today'";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1 AND order_date = '$today'";
$orderQuery = $connect->query($orderSql);
$countOrdertotal = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
    $totalRevenue += $orderResult['paid'];
}

$orderSqli = "SELECT SUM(order_item.quantity) AS nbre FROM orders, order_item WHERE order_item.order_id=orders.order_id AND orders.order_date='$today'";
$orderQueryi = $connect->query($orderSqli);
$orderResult1 = $orderQueryi->fetch_row();


if(!empty($orderResult1[0])){
    $nbreprod = $orderResult1[0];
} else {
    $nbreprod = 0;
}

$lowStockSql = "SELECT * FROM product WHERE quantity BETWEEN 1 AND 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;


$breakdowStockSql = "SELECT * FROM product WHERE quantity = 0 AND status = 1";
$breakdownStockQuery = $connect->query($breakdowStockSql);
$countBreakdownStock = $breakdownStockQuery->num_rows;

$connect->close();
?>


<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
    
</style>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <a href="product.php" style="text-decoration:none;color:black;">
                    Total Produits
                    <span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
                </a>
            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->
    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="orders.php?o=manord" style="text-decoration:none;color:black;">
                    Total Vente
                    <span class="badge pull pull-right"><?php echo $countOrdertotal; ?></span>
                </a>
            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->
    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <a href="product.php?stock=min" style="text-decoration:none;color:black;">
                    Stock minimal
                    <span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
                </a>
            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->
    <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="product.php?stock=rupture" style="text-decoration:none;color:black;">
				Rupture de Stock
                    <span class="badge pull pull-right"><?php echo $countBreakdownStock; ?></span>	
                </a>
            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->

    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
        <div class="card">
            <div class="cardHeader">
                <h1><?php echo date('d'); ?></h1>
                <h3 id="heure"></h3>
            </div>
            <div class="cardContainer" style="background: #ffffff">
                <p><?php echo utf8_encode(ucwords(strftime('%A %d %B %Y'))); ?></p>
            </div>
        </div> 
        <br/>        
        <div class="card">
            <div class="cardHeader" style="background-color: #ff0000">
                <h1><?php
                    if ($totalMontant) {
                        echo $totalMontant;
                    } else {
                        echo '0';
                    }
                    ?></h1>
            </div>
            <div class="cardContainer" style="background: #ffffff">
                <p><i class="glyphicon glyphicon-usd"></i> Montant Total Vendu (F CFA)</p>
            </div>
        </div> 

    </div>

    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
        <div class="card">
            <div class="cardHeader" style="background-color:#245580; height: 3.4em;">
                <h1><?php
                    if ($totalRevenue) {
                        echo $totalRevenue;
                    } else {
                        echo '0';
                    }
                    ?></h1>
            </div>

            <div class="cardContainer" style="background: #ffffff">
                <p> <i class="glyphicon glyphicon-usd"></i> Chiffre d'affaire du jour (F CFA)</p>
            </div>
        </div>
        
        <br/>
        <div class="card">
            <div class="cardHeader" style="background-color: #9999ff">
                <h1><?php
                       echo $nbreprod;
                    ?></h1>
            </div>
            <div class="cardContainer" style="background: #ffffff">
                <p> Nombre de Produits Vendus</p>
            </div>
        </div> 
        
        <br/>
    </div>
    
    <div class="col-md-5 col-xs-5 col-sm-5 col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendrier</div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>	
        </div>
    </div>


</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="assests/plugins/moment/sample_french.js" type="text/javascript"></script>


<script type="text/javascript">
    $(function () {
        // top bar active
        $('#navDashboard').addClass('active');

        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: 'title'
            },
            buttonText: {
                today: "Aujourd'hui",
                month: 'Mois'
            }
            //lang: "fr"
        });

        function dateJ() {
            $.ajax({
                url: "includes/server.php",
                data: {ok: 1},
                method: "POST",
                success: function (data) {
                    $('#heure').html(data);
                }
            });
        }

        /*Function Calls*/
        setInterval(function () {
            dateJ();
        }, 1000
                );//affiche la date 


    });
</script>

<?php require_once 'includes/footer.php'; ?>
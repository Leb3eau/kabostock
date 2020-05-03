<?php
require_once 'php_action/db_connect.php';

session_start();

if (isset($_SESSION['userId'])) {
    header('location: http://localhost:81/kabostock/dashboard.php');
}

$errors = array();

if ($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        if ($username == "") {
            $errors[] = "Username is required";
        }

        if ($password == "") {
            $errors[] = "Password is required";
        }
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $password = md5($password);
            // exists
            $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $mainResult = $connect->query($mainSql);

            if ($mainResult->num_rows == 1) {
                $value = $mainResult->fetch_assoc();
                $user_id = $value['user_id'];

                // set session
                $_SESSION['userId'] = $user_id;
                $_SESSION['userConn'] = $value['nom_prenom'];
                $_SESSION['userRole'] = $value['role'];

                header('location: http://localhost:81/kabostock/dashboard.php');
            } else {

                $errors[] = "Incorrect username/password combination";
            } // /else
        } else {
            $errors[] = "Username doesnot exists";
        } // /else
    } // /else not empty username // password
} // /if $_POST
?>

<!DOCTYPE html>
<html>
    <head>
        <title>DIGI CORP - Gestion de Stock</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- bootstrap theme-->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">
        <link rel="shortcut icon" href="assests/images/logo1.jpg" sizes="28x28" type="image/x-icon">
        <!-- custom css -->
        <link rel="stylesheet" href="custom/css/custom.css">	

        <!-- jquery -->
        <script src="assests/jquery/jquery.min.js"></script>
        <!-- jquery ui -->  
        <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
        <script src="assests/jquery-ui/jquery-ui.min.js"></script>

        <!-- bootstrap js -->
        <script src="assests/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body style="background-image: url(assests/images/background.png)">
        <div class="container">
            <div class="row vertical">
                <div class="col-md-5 col-md-offset-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Authentification... </h3>
                        </div>
                        <div class="panel-body">

                            <div class="messages">
                                <?php
                                if ($errors) {
                                    foreach ($errors as $key => $value) {
                                        echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									' . $value . '</div>';
                                    }
                                }
                                ?>
                            </div>

                            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="username" class="col-sm-4 control-label">Nom Utilisateur</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-4 control-label" style="margin-left: -2.7%">Mot de Passe</label>
                                        <div class="col-sm-8" style="margin-left: 2.7%">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                                        </div>
                                    </div>								
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default btn-lg"> <i class="glyphicon glyphicon-log-in"></i> Se Connecter</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!-- /panel -->
                </div>
                <!-- /col-md-4 -->
            </div>
            <!-- /row -->
        </div>
        <!-- container -->	
    </body>
</html>








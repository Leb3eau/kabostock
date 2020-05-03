<?php require_once 'includes/header.php'; ?>

<div class="row">    
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i>Rapports des utilisateurs
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">

                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <button type="submit" id="generateListUser" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Générer Liste</button>
                    </div>
                </div>


                <?php
                $sql = "SELECT * FROM users";
                $query = $connect->query($sql);

                $table = '<h3 class="text-center"> Liste des utilisateurs </h3> <br>
	<table class="table table-striped table-bordered" style="width:100%;">
		<thead>
			<th>#</th>
			<th><center>Username</center></th>
			<th><center>Email</center></th>
			<th><center>Rôle</center></th>
			<th><center>Option</center></th>
		</thead>

		<tbody>';
                $ix = 1;
                while ($result = $query->fetch_assoc()) {
                    $table .= '<tr>
				<td><center>' . $ix . '</center></td>
				<td><center>' . $result['username'] . '</center></td>
				<td><center>' . $result['email'] . '</center></td>
				<td><center>' . $result['role'] . '</center></td>
				<td><center><button class="btn btn-danger supp" user="' . $result['user_id'] . '" un="' . $result['username'] . '"> Supprimer</button></center></td>
				
			</tr>';
                    $ix++;
                }
                $table .= '
		</tbody>

		<tr>
			<td colspan="2"><center>TOTAL</center></td>
			<td><center>' . $query->num_rows . '</center></td>
		</tr>
	</table>
	';

                echo $table;
                ?>

            </div>
            <!-- /panel-body -->
        </div>
    </div>
    <!-- /col-dm-12 -->
</div>
<!-- /row -->

<?php
require_once 'php_action/core.php';

if (isset($_POST['l'])) {

    $Id = $_POST['id'];
    
    if (Id) {
        $sql = "DELETE FROM users WHERE user_id = {$Id}";
        $connect->query($sql);
        $connect->close();
    }
}
?>


<script src="custom/js/liste_user.js"></script>
<script>
    $(function () {

        $(".supp").click(function () {
            var uname = $(this).attr("un"),
                    id = $(this).attr("user");
            var conf = confirm("Vous allez vraiment supprimer l'utilisateur " + uname + " ?");
            if (conf) {
                $.ajax({
                    url: "liste_users.php",
                    type: "POST",
                    data: {l: 1, id: id},
                    success: function (response) {
                        location.reload(true);
                    }

                });
            }
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>
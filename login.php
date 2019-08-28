<?php $title = 'Connection';
session_start();
require_once 'instances/logininst.php';

include 'partials/_header.php';
include 'partials/_navigation.php';
?>

<div class="container">
	<table class="table table-striped table-bordered connection_table">
		<thead class="headin">
			<tr>
				<th>To make attendance please Login as Administrator</th>
			</tr>
		</thead>
		<tbody>
			<form method="post" action="login.php">
				<tr>
					<td>
						<div class="form-group col-md-12" >
							<label for="LastName">Administrator Last Name</label>
							<input type="text" name="username" class="form-control" id="LastName" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group col-md-12">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password" required>
						</div>
					</td>
				</tr>
				<tr>
					<td><br>
						<input type="submit" name="send" id="send" class="btn btn-success pull-right" value="Login Now">
					</td>
				</tr>
				
				
			</form>
			

		</tbody>
	</table>
	<?=
		isset($status)
		? '<span class="alert alert-success">'.$status.'</span>'
		:'';  

	?>
	
</div>



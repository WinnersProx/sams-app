<?php $title = 'Connection';

require_once 'instances/reginst.php';


include 'partials/_header.php';
include 'partials/_navigation.php';
?>

<div class="container">
	<table class="table table-striped table-bordered connection_table">
		<thead class="headin">
			<tr>
				<th>Create an administrator account</th>
			</tr>
		</thead>
		<tbody>
			<form method="post" action="registuser.php">
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
							<input type="password" name="a_password" class="form-control" id="password" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group col-md-12" >
							<label for="class">Your Class</label>
							<input type="text" name="class" class="form-control" id="class" required>
						</div>
					</td>
				</tr>
				<tr>
					<td><br>
						<input type="submit" name="send" id="send" class="btn btn-success pull-right" value="Create Now">
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



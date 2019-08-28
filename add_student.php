<?php $title = 'Add_students';
session_start();
require_once 'instances/addstudentinst.php';
include 'partials/_header.php';
include 'partials/_navigation.php';
?>

<div class="container">
	<table class="table table-striped table-bordered connection_table">
		<thead class="headin">
			<tr>
				<th>Add students in the system</th>
			</tr>
		</thead>
		<tbody>
			<form method="post" action="add_student.php">
				<tr>
					<td>
						<div class="form-group col-md-12" >
							<label for="studentName">Student Name</label>
							<input type="text" name="studentName" class="form-control" id="studentName" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group col-md-12">
							<label for="rollN">Student Roll Number</label>
							<input type="text" name="rollN" class="form-control" id="rollN" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group col-md-12">
							<label for="class">Class</label>
							<input type="text" name="class" class="form-control" id="class" required>
						</div>
					</td>
				</tr>
				<tr>
					<td><br>
						<input type="submit" name="add" id="add" class="btn btn-success pull-right" value="+ Add student">
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



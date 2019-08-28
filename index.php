
<?php
session_start();
require_once 'instances/indexinst.php';
$title = 'Dashboard';
include 'partials/_header.php';
include 'partials/_navigation.php';
?>
<div class="panel-body">
	<?=
	isset($status)
	? '<span class="alert alert-success">'.$status.'</span>'
	:'</br></br>';  

	?>
</div>
<div class="container">
			
		
	<div class="panel panel-default">
		<div class="panel panel-default">
		<div class="panel-footer">
			<br>
			<a href="add_student.php"><button type="button" class="btn btn-danger"><i class="fa fa-plus"></i> Add Students</button></a>
			<span style="padding-left:200px; "><strong>ULK STUDENT ATTENDANCE MANAGEMENT SYSTEM  <?= $t_date?></strong></span>
			<div class="pull-right">
				<a href="view.php"><button type="button" class="btn btn-success"><i class="fa fa-twitter"></i> View All</button></a>
			</div>
			<br>
		</div>
	</div>
		<form method="post">
		<div class="panel-body">
			<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>SN</th>
				<th>Roll Number</th>
				<th>Name</th>
				<th>Attendancence</th>
			</tr>
		</thead>
		<tbody>
			
			<?php $i =0?>
			<?php while($student = $q->fetch(PDO::FETCH_ASSOC)):?>
			<?php $i++;?>
			<tr>
				<td><?= $i ?></td>
				<td><?= $student['roll_number']?>
					<input type="hidden" name="dated" value="<?= $t_date?>" >
				</td>
				<td><?= $student['student_name']?></td>
				<td>
					Present
						<input type="radio" name="attend[<?= $student['roll_number']?>]" id="available" value="present" >
					
					Absent
						<input type="radio" name="attend[<?= $student['roll_number']?>]" id="unavailable" value="absent" >
					
					
				</td>
			</tr>
			<?php endwhile;?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><br>

					<input type="submit" name="mattend" id="send" class="btn btn-success pull-right" value="Validate"><i class="fa fa-validate"></i>
				</td>
			</tr>
			</form>	
		</tbody>
	</table>
			
		</div>
	
	
	</div>
	<div class="toggled" id="hidden" style="display: none;">
		Do you really want to add students?
	</div>



	
</div>

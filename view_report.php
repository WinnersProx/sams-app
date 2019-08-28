
<?php
session_start();
require_once 'instances/viewinst.php';
$title = 'Dashboard';
include 'partials/_header.php';
include 'partials/_navigation.php';
if(!empty($_GET['date'])){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$attend = $_POST['attend'];
	//$roll = $_POST['roll'];
	$updateAttend = $attendance->updateAttendance($_GET['date'], $attend);

}
if(isset($updateAttend)){
	$status = $updateAttend;
}
}
else{
	header('Location:view.php');
}




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
				<a href="index.php"><button type="button" class="btn btn-success"><i class="fa fa-twitter"></i> Back</button></a>
			</div>
			<br>
		</div>
		<div class="panel-footer">
			<p style="padding-left:360px; font-family: cornopop; color: green; font-size: 18px;"><strong>ATTENDANCE DONE ON <?= $_GET['date']?></strong></p>
		</div>
	</div>
		<form method="post">
		<div class="panel-body">
			<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>SN</th>
				<th>Roll</th>
				<th>Attendance</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$get_date_report = $attendance->get_date_report($_GET['date']);

			?>
			<?php if($get_date_report):?>
			<?php $i =0?>
			<?php while($student = $get_date_report->fetch(PDO::FETCH_ASSOC)):?>
			<?php $i++;?>
			<tr>
				<td><?= $i ?></td>
				<td><?= $student['roll']?></td>
				<td>
					Present
						<input type="radio" name="attend[<?= $student['roll']?>]" id="available" value="present" <?= $student['attend'] == 'present' ? 'checked': '';?>>
					
					Absent
						<input type="radio" name="attend[<?= $student['roll']?>]" id="unavailable" value="absent" <?= $student['attend'] == 'absent' ? 'checked': '';?>>
					
				</td>
			</tr>
			<?php endwhile;?>
			<?php endif;?>
			<tr>
				<td></td>
				<td></td>
				<td><br>

					<input type="submit" name="update" id="send" class="btn btn-success pull-right" value="Update"><i class="fa fa-spinner"></i>
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

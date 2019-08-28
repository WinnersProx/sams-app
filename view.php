
<?php
session_start();
require_once 'instances/viewinst.php';
$title = 'View';
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
			<span style="padding-left:200px; "><strong>ULK STUDENT ATTENDANCE MANAGEMENT SYSTEM REPORT</strong></span>
			<div class="pull-right">
				<button type="button" class="btn btn-success"><i class="fa fa-twitter"></i> Back</button>
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
				<th>Attendance Date</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if($get_date_list):?>
			<?php $i =0?>
			<?php while($student = $get_date_list->fetch(PDO::FETCH_ASSOC)):?>
			<?php $i++;?>
			<tr>
				<td><?= $i ?></td>
				<td><?= $student['dated']?></td>
				<td style="padding-top: 18px;">
					<a href="view_report.php?date=<?=$student['dated']?>"><button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i>View</button></a>
					
				</td>
			</tr>
			<?php endwhile;?>
			<?php endif;?>
			<tr>
				<td></td>
				<td></td>
				<td><br>

					<input type="submit" name="update" id="send" class="btn btn-success pull-right" value="Update"><i class="fa fa-validate"></i>
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

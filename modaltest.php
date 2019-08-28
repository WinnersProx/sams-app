<?php $title = 'Dashboard';

include 'partials/_header.php';
include 'partials/_navigation.php';
?>

<div class="container">
	<button type="button" class="btn btn-danger" data-toggle="modal" href="#hidden" >Add Students</button>
	
	<div class="toggled" id="hidden" style="display: none;">
		Do you really want to add students?
	</div>


	<!---->
	<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"> 
	Launch demo modal 
	</button> <!-- Modal --> 
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
					<h4 class="modal-title" id="myModalLabel"> 
						This Modal title
					</h4> 
				</div> 
				<div class="modal-body"> 
				Type the student name here:
				<input type="text" name="name" class="form-control" id="yourName"/><br/>
				Type the student roll number here: 
				<input type="text" name="name" class="form-control" id="yourName"/>
				</div> 
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Close </button> 
					<button type="submit" class="btn btn-primary">Submit</button> 
				</div> 
			</div><!-- /.modal-content --> 
		</div><!-- /.modal -->
	
</div>

<?php include 'partials/_footer.php';?>



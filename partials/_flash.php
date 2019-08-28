<?php if (isset($_SESSION['notification']['message'])){
	?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			
		</div>
		<div class="col-md-6">
			<div class="alert alert-<?= $_SESSION['notification']['type'] ?>">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><strong><?= $_SESSION['notification']['message'] ?></strong></h4>
			</div>
		</div>
	</div>
	
</div>

<?php }
$_SESSION['notification'] = [];



?>;
<?php include('includes/functions.php');?>
<div class="container">
			
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarcollapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<img src="imgs/ulklogc.png" alt="ulk" class="navbar-image pull-left"/>
						<a class="navbar-brand" href="index.php">ULK SAMS</a> 
				</div>
				<div>
				<div class="col-md-5 " id="psearch">
					<div class="form-group">
						<input type="search" name="q" placeholder="Rechercher" class="form-control" id="search" autocomplete="off" /><i class="fa fa-spinner fa-spin" style="display: none;" id="loader"></i>
						<div id="show_results">
							
						</div>

						<!--<input type="submit" name="seek" value="V" class="btn btn-search">-->
					</div>
					
				</div>
				</div>
				

				<div class="collapse navbar-collapse pull-right" id="navbarcollapse">
					
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
					</ul>
					<?php if(isset($_SESSION['admin'])):?>
					<ul class="nav navbar-nav">
						<li><a href="add_student.php">Add a student</a></li>
					</ul>
					
					<ul class="nav navbar-nav">
						<li><a href="logout.php">Logout</a></li>
					</ul>
					<?php else:?>
					<ul class="nav navbar-nav">
						<li><a href="login.php">Login</a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="registuser.php">Create Admin</a></li>
					</ul>
					<?php endif;?>
				
				</div>
			</div>
		</div>


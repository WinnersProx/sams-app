<div id="lists">
	<!--<?php //if(checks_friendship(get_session('id'))):?>-->
		<?php if(!empty($_GET['id']) && $_GET['id'] == get_session('id')):?>
			<br>
			<a href="#" id="poster"><p class="badge">Cliquer ici pour publier quelque chose</p></a>&nbsp;
			<div id="poster_id">
				<div class="status-post">
				<form action="micropost.php" method="post" data-parsley-validate>
					<div class="form-group">
						<label for="content" class="sr-only"><strong>Statut:</strong></label>
						<textarea id="content" name="content" rows="3" class="form-control" placeholder="A quoi pensez-vous" required="required" data-parsley-minlength="5" data-parsley-maxlength="120" ></textarea>
					</div>
					<div class="form-group status-post-submit">
						<input type="submit" name="post" class="btn btn-success " value="Publier">
					</div>

				</form>
				</div>

			</div>
			
		<?php endif;?>
		&nbsp;
		<div class="u_posts">
		<?php if(count($microposts) != 0):?>
			<?php foreach($microposts as $micropost) :?>
				<?php include('partials/_micropost.php');?>
			<?php endforeach ;?>
	    <?php else :?>
	    	<p class="alert-success" style="padding: 7px; border-radius: 4px;"><strong>Pas de statut actuellement!</strong></p>
		<?php endif ?>
		</div>
		
	<!--<?php// else:?>
		<p><strong><i>Envoyez une demande d'amitie a cet utilisateur 
		pour voir ses evenements!</i></strong></p>-->
	<!--<?php //endif;?>-->
</div>
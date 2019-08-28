	<div class="row group">
		<p class="p-heading"><strong>Informations de l'utilisateurs</strong></p>
		<strong><?= $user->pseudo?></strong><br>
		<a href="mailto:<?=$user->email?>"><?= $user->email?></a><br/>
		<?=
			 
			$user->city && $user->country ? $user->city.'-'.$user->country : '';

		?><br/>
		<a href="https://www.google.map/maps?q=<?= $user->city.'-'.$user->country ?>" target="blank">Voir sur Google Maps</a><br/>
		<?=
		 
		$user->twitter? '<i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;<a href="//twitter.com/'.e($user->twitter).'">@'.e($user->twitter).'</a><br/>' : '';

	?><br>
	<?=
		 
		$user->github?'<i class="fa fa-github" aria-hidden="true">&nbsp;</i><a href="//github.com/'.e($user->github).'">@'.e($user->github).'</a><br/>' : '';

	?><br>
	<?=
		$user->sex == "H" 
		? '<i class="fa fa-male" aria-hidden="true"></i>'
		: '<i class="fa fa-female" aria-hidden="true"></i>';
	?>
	<?=
		 
		$user->available_for_hiring ? '<strong>Disponible Pour emploi</strong><br/>' : '<strong>Non disponible pour emploi</strong>';

	?>
	</div><br>
	<div class="row group">
		<div class="p-heading">
			<p><strong>Description de <?= $user->pseudo ?></strong></p>
		</div>
		<p>
		<?=
		$user->bio ? e(nl2br($user->bio)) : 'Aucune Biographie actuelle';
		?>
		</p>
	</div>
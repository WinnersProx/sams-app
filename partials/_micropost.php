<div class = "media status-media " id="article<?= $micropost->id;?>">
	<div class="pull-left">
		<img src="<?= $user->avatar
		? $user->avatar
		: 'uploads/user.png'//get_avatar_url($user->emal)?>" title ="<?=$user->pseudo?>" alt="<?= $user->pseudo?>" class="media-object user-avatar-xs">
		
	</div>
	<div media-body>
		<h4 class="media-heading"><?= $user->pseudo?></h4>
		<p>&nbsp;<i class="fa fa-clock-o"></i><span class="timeago" title="<?= $micropost->created_at?>"><?= $micropost->created_at?></span></p>
		
		<strong><?= nl2br(animate_links(e($micropost->content))); ?></strong>
		<p><a href="delete_micropost.php?id=<?= $micropost->id?>">supprimer</a></p>
	</div>
	<p class="padd"></p>
	<p>
		<?php if(just_liked_by_user($micropost->id)):?>
		<span class="badge" >
			<a data-action="unlike"  href="unlike_micropost.php?id=<?= $micropost->id;?>" style="color: green;" class="like" id ="unlike<?= $micropost->id?>">
				Je n'aime plus</a>
				<!--<?php //unlike_micropost($micropost->id);?>-->
		</span>&nbsp;
		<?php else:?>
			<span class="badge" >
				<a data-action="like" href="like_micropost.php?id=<?= $micropost->id;?>" style="color: green;" class="like" id ="like<?= $micropost->id?>">J'aime</a>
				<!--<?php //like_micropost($micropost->id);?>-->
			</span>
		<?php endif;?>

		<?=get_nbr_likes($micropost->id)?>
		<?= get_nbr_likes($micropost->id) > 1
		? 'Likes'
		: 'Like';
		?>
		<div id="likers_<?= $micropost->id?>" class="badge">
			
			<?= show_likers($micropost->id);?>
		</div>
	</p>
	
									
</div>
<p>Listes des amis en ligne...</p>
	<div>
		<?php
		$session = get_session('id');
		$friends = show_user_friends($session);
		 
		?>
		<?php foreach ($friends as $friend):?>
		<a href="sendmessage.php?sender_id=<?=get_session('id')?>&&receiver_id=<?=$friend->id?>" class="display_interface">
		<div class="show-user-box">
				<img src="<?= $friend->avatar ? $friend->avatar : 'uploads/user.png'?>" class="user-avatar-xs " alt="<?=e($friend->pseudo)?>">&nbsp;<?= $friend->pseudo?>
			
		</div>
		</a>
		<?php endforeach;?>
	</div>
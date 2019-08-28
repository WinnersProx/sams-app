<?php if(right_relation_link($_GET['id']) == CANCEL_RELATION_L):?>

		<p>Demande deja envoyee&nbsp;<a href="delete_friend_request.php?id=<?= $_GET['id']?>">Annuler la demande</a></p>
		

<?php elseif(right_relation_link($_GET['id']) == ADD_RELATION_L):?>

		<a href="add_friend.php?id=<?= $_GET['id'];?>" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>

<?php elseif(right_relation_link($_GET['id']) == DELETE_RELATION_L):?>
		<a href="delete_friend_request.php?id=<?= $_GET['id']?>" class="badge">Retirer de mon repertoire</a>
<?php elseif(right_relation_link($_GET['id']) == ACCEPT_REJECT_L):?>
		<a href="confirm_friend_request.php?id=<?= $_GET['id']?>" class="btn btn-primary">Accepter</a>&nbsp;
		<a href="delete_friend_request.php?id=<?= $_GET['id']?>" class="btn btn-danger">Rejeter</a>
<?php endif;?>
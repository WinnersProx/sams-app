<?php

if(!function_exists('e')){// same as function exists//
	function e($string){
		if($string){
			return htmlspecialchars($string);
		}
	}
	
}
//
//checks if user has just liked the given post
if(!function_exists('just_liked_by_user')){// same as function exists//
	function just_liked_by_user($micropost_id){
		global $bdd;
		$q = $bdd->prepare('SELECT id FROM micropost_likes 
						WHERE user_id =:user_id AND micropost_id=:micropost_id'
		);

		$q->execute([
		'user_id' => get_session('id'),
		'micropost_id' => $micropost_id

		]);
		return (bool) $q->rowCount();
	}
	
}
//
if(!function_exists('show_user_friends')){// same as function exists//
	function show_user_friends($connected_user){
		global $bdd;
		$q = $bdd->prepare("SELECT friendship_relations.user_id1 , friendship_relations.status, friendship_relations.user_id2, users.id , users.pseudo, users.avatar FROM friendship_relations 
                            LEFT JOIN users
                            ON users.id = friendship_relations.user_id2
                            WHERE friendship_relations.user_id1 =:user_id1  
                            AND friendship_relations.status = '1' "
		);

		$q->execute([
		'user_id1' => $connected_user
		]);
		
		$results = $q->fetchAll(PDO::FETCH_OBJ);
		return $results;

	}
	
}

//

//like and dislike the micropost
if(!function_exists('like_micropost')){// same as function exists//
	function like_micropost($micropost_id){
		global $bdd;
		$q = $bdd->prepare('INSERT INTO micropost_likes(user_id, micropost_id) 
							VALUES(:user_id, :micropost_id)'
		);

		$q->execute([
		'user_id' => get_session('id'),
		'micropost_id' => $micropost_id

		]);
		$q = $bdd->prepare('UPDATE micropost SET count_likes = count_likes + 1 WHERE id=?'
		);

		$q->execute([
			$micropost_id
		]);
	
	}
	
}
//
if(!function_exists('unlike_micropost')){// same as function exists//
	function unlike_micropost($micropost_id){
		global $bdd;
			$q = $bdd->prepare('DELETE FROM micropost_likes WHERE user_id = :user_id AND micropost_id =:micropost_id'
			);

			$q->execute([
			'user_id' => get_session('id'),
			'micropost_id' => $micropost_id

			]);
			//updating u//
			$q = $bdd->prepare('UPDATE micropost SET count_likes = count_likes - 1 WHERE id=?'
			);

			$q->execute([
				$micropost_id
			]);
	}		
}


//
//Count nbr friends in database-->
if(!function_exists('nbr_friends')){// same as function exists//
	function nbr_friends($id){
		global $bdd;

		$q = $bdd->prepare("SELECT status FROM friendship_relations WHERE (user_id1 = :connected_user OR user_id2 = :connected_user) AND status = '1' ");
		$q->execute([
			'connected_user' => $id
		]);
		$countr = $q->rowCount();
		$q->closeCursor();
		return $countr;

	}
	
}


//
//checkas whether a friend_request was just sent to avoid duplication in db
if(!function_exists('checks_sent_requests')){// same as function exists//
	function checks_sent_requests($id1, $id2){
		global $bdd;
		$q = $bdd->prepare("SELECT status FROM friendship_relations WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
		$q->execute([
			'user_id1' => $id1,
			'user_id2' => $id2
		]);
		$countr = $q->rowCount();
		$q->closeCursor();
		return (bool) $countr;

	}
	
}
//checks if the connected user is friend with another one//
if(!function_exists('checks_friendship')){// same as function exists//
	function checks_friendship($target_id){
		global $bdd;
		$q = $bdd->prepare("SELECT status FROM friendship_relations WHERE ((user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1)) AND status = '1'");
		$q->execute([
			'user_id1' =>get_session('id'),
			'user_id2' => $target_id
		]);
		$countr = $q->rowCount();
		$q->closeCursor();
		return (bool) $countr;

	}
	
}
//checks if two people are friend//
//get number of likes
if(!function_exists('get_nbr_likes')){// same as function exists//
	function get_nbr_likes($post_id){
		global $bdd;

		$q = $bdd->prepare('SELECT count_likes FROM micropost WHERE id = ?');
		$q->execute([
			$post_id
		]);
		$result = $q->fetch(PDO::FETCH_OBJ);
		return intval($result->count_likes);

	}
	
}
//
if(!function_exists('get_likers')){// same as function exists//
	function get_likers($micropost_id){
		global $bdd;
		$q = $bdd->prepare("SELECT users.id, users.pseudo FROM users
						   LEFT JOIN micropost_likes 
						   ON users.id = micropost_likes.user_id 
						   WHERE micropost_likes.micropost_id = ?
						   ORDER BY micropost_likes.id DESC
						   LiMIT 3
						   
		");
		$q->execute([
			$micropost_id

		]);

		return $q->fetchAll(PDO::FETCH_OBJ);
		//return $result;


		

	}
	
}
//
//checks if the connected user has liked the micropost
if(!function_exists('checks_if_connected_user_liked_a_post')){// same as function exists//
	function checks_if_connected_user_liked_a_post($micropost_id){
		global $bdd;
		$q = $bdd->prepare("SELECT id FROM micropost_likes WHERE micropost_id =? AND user_id=?");
		$q->execute([
			$micropost_id,
			get_session('id')
		]);
		$countr = $q->rowCount();
		$q->closeCursor();
		return (bool) $countr;
	}
	
}
//
if(!function_exists('find_user_liking')){// same as function exists//
	function find_user_liking($micropost_id){
		global $bdd;
		$q = $bdd->prepare("SELECT user_id FROM micropost_likes WHERE micropost_id =?");
		$q->execute([
			$micropost_id,
		]);
		$users = $q->fetch(PDO::FETCH_OBJ);
		//$q->closeCursor();
		foreach ($users as $user) {
			echo $user->user_id;
		}
		
	}
	
}

//
//
//to display people liking posts
if(!function_exists('show_likers')){// same as function exists//
	function show_likers($micropost_id){
		$count_likes = get_nbr_likes($micropost_id);
		$likers = get_likers($micropost_id);
		$result = '';

		if($count_likes > 0){
			$remaining_likers_count = $count_likes - 3;
			$connected_user_liked = checks_if_connected_user_liked_a_post($micropost_id);
			foreach ($likers as $like){
				if(get_session('id') !== $like->id){
					$result .= '<a style="color:black;" href="profile.php?id='.$like->id.'">'. e($like->pseudo).'</a>, ';
				}

			}
			$result = $connected_user_liked ? 'Vous, '.$result : $result;
			$result = trim($result, ', ');
			if(($count_likes == 2 || $count_likes == 3) && $result != ""){
				$tabl = explode(',' , $result);
				$last_Item = array_pop($tabl);
				$result = implode(',', $tabl);
				$result .= ' et ' . $last_Item;
			}
			$result = trim($result, ',');
			switch ($count_likes) {
				case 1:
					$result .= $connected_user_liked ?' aimez ce poste.' : ' aime ce poste';
					break;
				case 2:
				case 3:
					$result .= $connected_user_liked ? ' aimez ce poste' : 'aiment ce poste';
					break;
				case 4:
					$result .= $connected_user_liked ? 
					' et une autre personne aimez ce poste'
					: ' et une autre personne aiment ce poste';
					break;
				default:
					$result .= $connected_user_liked ?
					' et '.$remaining_likers_count. 'autres personnes aimez ce poste'
					: ' et '.$remaining_likers_count. 'autres personnes aiment ce poste';
					break;
			}
		
		}
		return $result;
	}
	
}
//


//test if there is a record in our database
if(!function_exists('right_relation_link')){// same as function exists//
	function right_relation_link($id){
		global $bdd;
		$q = $bdd->prepare("SELECT status,user_id1,user_id2 FROM friendship_relations WHERE (user_id1 =:user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1) ");
		$q->execute([
			'user_id1' => get_session('id'),
			'user_id2' => $id
		]);

		$data = $q->fetch();
		//$q->closeCursor();

		if($data['user_id1'] == $id  && $data['status'] == '0')
		{
			//return true;Lien pour accepter ou refuser  la demande
			return "accept_reject_link";
		}
		elseif($data['user_id1'] == get_session('id') && $data['status'] == '0')
		{	
			//msg confirmant l'envoi de la demande Lien pour annuler la demande
			return "cancel_relation_link";
		}
		elseif($data['user_id1'] == get_session('id') OR $data['user_id1'] == $id  && $data['status'] == '1')
		{
			//Lien pour la suppression de la relation
			return "delete_relation_link";
		}
		else
		{
			//lien pour ajouter la personne comme ami
			return "add_relation_link";
		}
	}
}
	

//
//
//replace links and make them clickable
if(!function_exists('animate_links')){// same as function exists//
	function animate_links($text){
		$regExp_url = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
		return preg_replace($regExp_url, 
							"<a href=\"$0\" target=\"_blank\">$0</a>",
			 				$text
		);
	}
	
}
//replace links
if(!function_exists('cell_count')){// same as function exists//
	function cell_count($table, $field_name, $field_value){
		global $bdd;
		$q = $bdd->prepare("SELECT *FROM $table WHERE $field_name = ?");
		$q->execute([$field_value]);
		return $q->rowCount();



	}
	
} 
//

//remember me for cookies
if(!function_exists('remember_me')){// same as function exists//
	function remember_me($user_id){
		global $bdd;
		//generer le token aleatoirement
		$token = openssl_random_pseudo_bytes(24); 
		
		//generer le selecteur de meme aleatoirement qui devra etre unique
		do{
			$selector = $token = openssl_random_pseudo_bytes(9);
		}
		while(cell_count('tokens', 'selector', $selector) > 0);
		//enregistrer les infos (user_id,selector,expires(14 jours)) stoken(hashed) en base de donnees
		$q = $bdd->prepare("INSERT INTO tokens(expires, selector, user_id,token)
			VALUES(DATE_ADD(NOW(), INTERVAL 14 DAY), :selector, :user_id, :token)

			");
		$q->execute([
			'selector' => $selector,
			'user_id' => $user_id,
			'token' => hash('sha256', $token)

		]);
		//creer un cookie auth (14jours)// httponly = true
		//contenu : base 64_encode(selector).':'.base64_encode(token)
		setcookie('auth', 
			base64_encode($selector).':'.base64_encode($token), 
			time() + 1209600,
			null,
			null, 
			false,
			true
		);
		
	}
	
}
 //remember me for cookies
//auto login
if(!function_exists('auto_login')){// same as function exists//
	function auto_login(){
		global $bdd;
		//verifier si notre cookie existe aiuth
		if(!empty($_COOKIE['auth'])){
			$split = explode(':', $_COOKIE['auth']);
			if(count($split) !== 2){
				return false;
			}
			//recuperer le selecteur et le token via le cookie
			list($selector,$token) = $split;
			$q = $bdd->prepare("SELECT tokens.token, tokens.user_id ,  
								users.id id_user, users.pseudo, users.email, users.avatar
								FROM tokens 
								LEFT JOIN users
								ON tokens.user_id = users.id
								WHERE  selector = ? AND 
								expires >= CURDATE()");//date courrante curdate
			$q->execute([base64_decode($selector)]);
			$result = $q->fetch(PDO::FETCH_OBJ);
			//Decoder le selecteur utilisant base64_decode
		//verifier au niveau de la bdd s'il y a un enregistrement qui a comme selecteur $selecteur
		//si l'enregistrement est trouve on compare les deux tokens
			if($result){
				if(hash_equals($result->token, hash('sha256', base64_decode($token)))){
					session_regenerate_id(true);
					$_SESSION['id']     = $result->id_user;
					$_SESSION['pseudo'] = $result->pseudo;
					$_SESSION['avatar'] = $result->avatar;
					$_SESSION['email']  = $result->email;

					//(si on est bon) on stocke les donnees en session
					//$_SESSION['id'] = $user->id, $_SESSION['password'] = $user->password// ainsi de suite

					return true;
				}
			}

			
		}
		return false;
		
		
		
	
	}
	
}
//auto login
//function allowing friendly redirections
if(!function_exists('redirect_intent_page')){// same as function exists//
	function redirect_intent_page($default_url){
		if($_SESSION['forwarding_url']){
			$url =  $_SESSION['forwarding_url'];
		}
		else
		{
			$url = $default_url;
		}
		$_SESSION['forwarding_url'] = null;
		redirect($url);
	}
	
}
//get number of users
if(!function_exists('nbr_users')){// same as function exists//
	function nbr_users(){
	global $bdd;
	$q = $bdd->query("SELECT id FROM users WHERE active = '1' ORDER BY pseudo ");
	$get_bage = $q->rowCount();
	return $get_bage;
	}
	
}
//get the session value
if(!function_exists('get_session')){// same as function exists//
	function get_session($key){
		if($key){
			return !empty($_SESSION[$key])?
			e($_SESSION[$key])
			:null
			;
		}
	}
	
}
//get the current localse lang
if(!function_exists('get_current_locale')){// same as function exists//
	function get_current_locale(){
		return $_SESSION['locale'];
	}
	
}
//find a user by his own id
if(!function_exists('get_user_by_id')){// same as function exists//
	function get_user_by_id($field){
			global $bdd;
			$q = $bdd->prepare("SELECT name, pseudo, email,sex,city,country,twitter,available_for_hiring, github, bio,avatar FROM users WHERE id = ?");
			$q->execute([$field]);
			// current ici bas va me servir ne pas recuperer chaque objet par sa cle;
			$data = $q->fetch(PDO::FETCH_OBJ);
			$q->closeCursor();
			return $data;

	}
	
}
//function for our code //>>>
if(!function_exists('get_code_by_id')){// same as function exists//
	function get_code_by_id($id){
			global $bdd;
			$q = $bdd->prepare("SELECT scode FROM codes WHERE id = ?");
			$q->execute([$id]);
			// current ici bas va me servir ne pas recuperer chaque objet par sa cle;
			$datas = $q->fetch(PDO::FETCH_OBJ);
			$q->closeCursor();
			return $datas;

	}
	
}
//fonction de hashage tres puissant Using Blofish Algorithm
/*if(!function_exists('bcrypt_hash_password')){// same as function exists//
	function bcrypt_hash_password($value, $options = array()){
			$cost = isset($options['rounds']) ? $options['rounds'] : 10;
			$hash = password_hash($value, PASSWORD_BCRYPT,array('cost'=>$cost));
			if($hash === false){
				throw new Exception("Bcrypt n'est pas supporte ici!");
				
			}
			return $hash;

	}
	
}
//Verifies if the entered password correspond to Bcript hash
if(!function_exists('bcrypt_verify_password')){// same as function exists//
	function bcrypt_verify_password($value, $hashed_value){
		return password_verify($value, $hashed_value);

	}
	
}
*/
//Get Avatar email for user email

if(!function_exists('get_avatar_url')){// same as function exists//
	function get_avatar_url($email, $size = 25){
		return "https://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size;
	}
	
}

//Verifies if user is logged in
if(!function_exists('user_logged_in')){// same as function exists//
	function user_logged_in(){
		return isset($_SESSION['id']) || isset($_SESSION['pseudo']);

	}
	
}


if(!function_exists('not_empty')){// same as function exists//
	function not_empty($fields = []){
		if (count($fields) != 0) {
			foreach ($fields as $field) {
				if (empty($_POST[$field]) || trim($_POST[$field]) ==''){
					return false;
				}
			}
			return true;
		}

	}
}
if(!function_exists('is_already_in_use')) {
	function is_already_in_use($field, $value, $table){
		global $bdd;
		$q = $bdd->prepare("SELECT id FROM $table WHERE $field = ?");
		$q->execute([$value]);
		$countr = $q->rowCount();
		$q->closeCursor();
		return $countr;


	}
	
}
if(!function_exists('set_flash')){
	function set_flash($message, $type = 'info'){
		$_SESSION['notification']['message'] = $message;
		$_SESSION['notification']['type']= $type;


	}
}
if(!function_exists('redirect')){
	function redirect($page){
		header('Location:'.$page);
		exit();
	}
}

if(!function_exists('save_input_data')){
	function save_input_data(){
		foreach($_POST as $key => $value){
			if(strpos($key, 'password'|| 'register') === false){
				$_SESSION['input'][$key] = $value;
			}
			
		}
	}
}

if(!function_exists('get_input')){
	function get_input($key){
		return !empty($_SESSION['input'][$key])
		? e($_SESSION['input'][$key])
		: null;
	}
}
if(!function_exists('clear_input_data')){
	function clear_input_data(){
		if(isset($_SESSION['input'])){
			$_SESSION['input'] =[];
		}
	}
}
// Gere l'etat actuel du menu particulierement la classe
if(!function_exists('set_active')){
	function set_active($file, $class = 'active'){
		$page = array_pop(explode('/',$_SERVER['SCRIPT_NAME']));
		if ($page == $file.'.php'){
			return $class;
		}
		else{
			return '';
		}

	}
}



//This function concers the custmization writting of my urls

/*if(!function_exists('url_custom_enconde')){
	function url_custom_encode($titre) {
   $titre = htmlspecialchars($titre);
   $find = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Œ', 'œ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Š', 'š', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ÿ', '?', '?', '?', '?', 'Ž', 'ž', '?', 'ƒ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
     $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
     $titre = str_replace($find, $replace, $titre);
   $titre = strtolower($titre);
   $mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);
   $encoded = "";
   foreach($mots as $mot) {
      if(strlen($mot) >= 3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
         $encoded .= $mot.'/';
      }
   }
   $encoded = substr($encoded, 0, -1);
   return $encoded;
}

}
*/


?>
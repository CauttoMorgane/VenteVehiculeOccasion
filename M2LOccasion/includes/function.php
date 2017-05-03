<?php
	define('VISITEUR',0);
	define('INSCRIT',1);
	define('ADMIN',2);
?>

<?php
	function verif_auth($auth_necessaire)
	{
		$level=(isset($_SESSION['level']))?$_SESSION['level']:1;
		return ($auth_necessaire <= intval($level));
	}	
?>

<?php
	function move_photo($photo)
	{
    	$extension_upload = strtolower(substr(  strrchr($photo['name'], '.')  ,1));
    	$name = time();
    	$nomphoto = str_replace(' ','',$name).".".$extension_upload;
    	$name = "includes/photosAnnonces/".str_replace(' ','',$name).".".$extension_upload;
    	move_uploaded_file($photo['tmp_name'],$name);
    	return $nomphoto;
	}
?>
<?php

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=automobile', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>
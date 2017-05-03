<?php
	session_start();
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");
	
	if ($id != null) {
			header("Location:membre.php");
		}
?>
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h1>M2LOccasion
						<small>Connexion</small>
					</h1>
				</div>
			</div><!--fin row-->
			<hr>
			<div class="row">
				<div class="container-fluid">
<?php
	if (!isset($_POST['login'])) //On est dans la page de formulaire
	{
?>
					<form class="form-horizontal" method="post" action="login.php">
						<fieldset>
							<legend></legend>
							<div class="form-group <?php echo !empty($loginError)?'error':'';?>">
								<label class="col-md-4 control-label" for="login">Identifiant</label>  
								<div class="col-md-4">
									<input type="text" name="login" value="<?php echo !empty($login)?$login:'';?>" placeholder="Identifiant" class="form-control input-md" requierd/>
										<?php if (!empty($loginError)): ?>
											<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $loginError;?></span></div>
										<?php endif; ?>
								</div>
							</div>
							<div class="form-group <?php echo !empty($mdpError)?'error':'';?>">
								<label class="col-md-4 control-label" for="mdp">Mot de passe</label>  
								<div class="col-md-4">
									<input type="password" name="mdp" value="<?php echo !empty($mdp)?$mdp:'';?>" placeholder="Mot de passe" class="form-control input-md" requierd/>
										<?php if (!empty($mdpError)): ?>
											<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $mdpError;?></span></div>
										<?php endif; ?>
								</div>
							</div>
						</fieldset>
						<fieldset>
						<legend></legend>
							<div class="form-group">
								<label class="col-md-4 control-label" for="submit"></label>
								<div class="col-md-4">
									<input type="submit" name="submit" value="Connexion" class="btn btn-success btn-block"/>
								</div>
							</div>
						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label"></label>  
								<div class="col-md-4">
									<p><a href="inscription.php">Pas encore inscrit ?</a></p>
								</div>
							</div>
					</form>
				</div>
			</div>
<?php
	}

	else
	{
		$message='';
		if (empty($_POST['login']) || empty($_POST['mdp']) ) //Oublie d'un champ
		{
			$message = '<div class="alert alert-danger" role="alert">
							<strong>Une erreur s\'est produite pendant votre identification. </strong>
							Vous devez remplir tous les champs
							<br /><a class="label label-default" href="login.php">Cliquez ici pour revenir à la page de connexion</a>
						</div>';
		}
		else //On check le mot de passe
		{
			$query=$db->prepare('SELECT user_mdp, user_id, user_lvl, user_login
								 FROM auto_user WHERE user_login = :login');
			$query->bindValue(':login',$_POST['login'], PDO::PARAM_STR);
			$query->execute();
			$data=$query->fetch();
			
			if ($data['user_mdp'] == md5($_POST['mdp'])) // Acces OK !
			{
				if ($data['user_lvl']== 2)
				{
					$_SESSION['login'] = $data['user_login'];
					$_SESSION['level'] = $data['user_lvl'];
					$_SESSION['id'] = $data['user_id'];
					header("Location:admin.php");
				}else{
					$_SESSION['login'] = $data['user_login'];
					$_SESSION['level'] = $data['user_lvl'];
					$_SESSION['id'] = $data['user_id'];
					header("Location:membre.php");
				}				
			}
			else // Acces pas OK !
			{
				$message = '<div class="alert alert-danger" role="alert">
								<strong>Une erreur s\'est produite pendant votre identification. </strong>
								Le mot de passe ou le login entré n\'est pas correcte.
								<br /><a class="label label-default" href="login.php">Cliquez ici pour revenir à la page de connexion</a>
							</div>';
			}
				$query->CloseCursor();
		}
		echo $message.'</div><br /><br /><br /></body></html>';

	}
?>
		</div>
		<br />
		<br />
		<br />
	</body>
</html>
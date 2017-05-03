<?php 
        include("includes/debut.php");
		
    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){
    
       //on initialise nos messages d'erreurs;
        $nameError = '';
        $firstnameError='';
        $emailError ='';
		$telError ='';
		$fixeError ='';
		$villeError ='';
		$cpError ='';
		$loginError ='';
		$mdpError ='';
		$mdpConfError ='';
		$validError ='';
		
        
        // on recupère nos valeurs 
        $name = htmlentities(trim($_POST['name']));
        $firstname = htmlentities(trim($_POST['firstname']));
        $email = htmlentities(trim($_POST['email'])); 
        $tel = htmlentities(trim($_POST['tel']));
        $fixe = htmlentities(trim($_POST['fixe']));
        $ville = htmlentities(trim($_POST['ville']));
        $cp = htmlentities(trim($_POST['cp']));
        $login = htmlentities(trim($_POST['login']));
        $mdp = htmlentities(trim($_POST['mdp']));
        $mdpConf = htmlentities(trim($_POST['mdpConf']));
        #$mdp = md5($_POST['mdp']);
        #$mdpConf = md5($_POST['mdpConf']);
         
        // on vérifie nos champs
        $valid = true;
        if (empty($name)) {
            $nameError = 'Merci d\'entrer un Nom';
            $valid = false;
        }else if (!preg_match("/^[\p{L}-]*$/",$name)) {
            $nameError = "Only letters and white space allowed"; 
			$valid = false;
        }
		
        if(empty($firstname)){
            $firstnameError = 'Merci d\'entrer un Prénom';
            $valid = false;
        }else if (!preg_match("/^[\p{L}-]*$/",$firstname)) {
            $nameError = "Only letters and white space allowed";
			$valid = false;
		} 
		
        if (empty($email)) {
            $emailError = 'Merci d\'entrer un E-mail';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
		$query = $db->prepare('SELECT COUNT(*) AS nbr FROM auto_user WHERE user_mail =:email');
		$query->bindValue(':email',$email, PDO::PARAM_STR);
		$query->execute();
		$email_free = ($query->fetchColumn()==0)?1:0;
		$query->CloseCursor();
		
		if(!$email_free)
		{
			$emailError = "Cette adresse email est déjà utilisée par un autre membre";
			$valid = false;
		}
		
        if (empty($fixe)) {
            $fixeError = 'Merci d\'entrer un N° de téléphone fixe';
            $valid = false;
        }else if(!preg_match("#^0[0-9]{9}$#",$fixe)){
			//#^0[1-79]([-. ]?[0-9]{2}){4}$#
            $fixeError = 'Please enter a valid phone';
            $valid = false;
        }
		
		if (empty($tel)) {
            $telError = 'Merci d\'entrer un N° de téléphone';
            $valid = false;
        }else if(!preg_match("#^0[0-9]{9}$#",$tel)){
			//#^0[1-79]([-. ]?[0-9]{2}){4}$#
            $telError = 'Merci d\'entrer un numéro de téléphone valide';
            $valid = false;
        }
		
		if(empty($ville)){
            $villeError ='Merci d\'entrer un Prenom';
            $valid = false;
        }else if (!preg_match("/^[\p{L}- ]*$/",$ville)) {
            $villeError = "Only letters and white space allowed"; 
			$valid = false;
        } 
		
		if (empty($cp)) {
            $cpError = 'Merci d\'entrer un code postal';
            $valid = false;
        }else if(!preg_match("#^[0-9][1-9]([0-9]{3})$#",$cp)){
            $cpError = 'Merci d\'entrer un code postal valide';
            $valid = false;
        }
		
		if (empty($login)) {
            $loginError = 'Merci d\'entrer un Identifiant';
            $valid = false;
        }
		$query=$db->prepare('SELECT COUNT(*) AS nbr FROM auto_user WHERE user_login =:login');
		$query->bindValue(':login',$login, PDO::PARAM_STR);
		$query->execute();
		$login_free=($query->fetchColumn()==0)?1:0;
		$query->CloseCursor();
		if(!$login_free)
		{
			$loginError = "Ce login est déjà utilisé par un autre membre";
			$valid = false;
		}
		if (empty($mdp)) {
            $mdpError = 'Merci d\'entrer un Mot de passe';
            $valid = false;
        }
		if (empty($mdpConf)) {
            $mdpConfError = 'Merci de Confirmer le mot de passe';
            $valid = false;
        }else if($mdp != $mdpConf) {
			$mdpConfError = "Le Mot de passe et la Confirmation sont diffèrent";
			$valid = false;
		}
        
        // si les données sont présentes et bonnes, on se connecte à la base
        if ($valid==true) {
			$query=$db->prepare("INSERT INTO auto_user (user_nom, user_prenom, user_tel, user_fixe, user_cp, user_ville, user_mail, user_login, user_mdp, user_lvl) 
								values(?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
            $query->execute(array($name, $firstname, $tel, $fixe, $cp, $ville, $email, $login, md5($mdp)));
            header("Location: membre.php");
        }
    }
?>
		<section>
			<div class="container">
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<h1 class="section-heading">Inscription M2LOccasion </h1>
						<p class="lead section-lead">M2LOccasion site de vente de véhicule d'Occasion.</p>
						<p class="section-paragraph">Vous inscrire sur M2LOccasion vous permettra d’ajouté des annonces.</p>
					</div>
				</div>
			</div>	
			
			<div class="container">
				<br />
				<form class="form-horizontal" method="post" action="inscription.php">
					<fieldset>
						<legend></legend>
						<div class="form-group <?php echo !empty($nameError)?'error':'';?>">
							<label class="col-md-4 control-label" for="name">Nom</label>  
							<div class="col-md-4">
								<input type="text" name="name" value="<?php echo !empty($name)?$name:'';?>" placeholder="Nom" class="form-control input-md" requierd/>
									<?php if (!empty($nameError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $nameError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($firstnameError)?'error':'';?>">
							<label class="col-md-4 control-label" for="firstname">Prénom</label>  
							<div class="col-md-4">
								<input type="text" name="firstname" value="<?php echo !empty($firstname)?$firstname:''; ?>" placeholder="Prenom" class="form-control input-md"requierd/>
									<?php if(!empty($firstnameError)):?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $firstnameError ;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($emailError)?'error':'';?>">
							<label class="col-md-4 control-label" for="email">E-mail</label>  
							<div class="col-md-4">
								<input type="text" name="email" value="<?php echo !empty($email)?$email:'';?>" placeholder="E-mail" class="form-control input-md" requierd/>
									<?php if(!empty($emailError)):?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $emailError ;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($fixeError)?'error':'';?>">
							<label class="col-md-4 control-label" for="fixe">Téléphone Fixe</label>  
							<div class="col-md-4">
								<input type="text" name="fixe" value="<?php echo !empty($fixe) ? $fixe:'';?>" placeholder="Fixe" class="form-control input-md" requierd/>
									<?php if (!empty($fixeError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $fixeError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($telError)?'error':'';?>">
							<label class="col-md-4 control-label" for="tel">Téléphone Portable</label>  
							<div class="col-md-4">
								<input type="text" name="tel" value="<?php echo !empty($tel) ? $tel:'';?>" placeholder="Portable" class="form-control input-md" requierd/>
									<?php if (!empty($telError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $telError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($villeError)?'error':'';?>">
							<label class="col-md-4 control-label" for="ville">Ville</label>  
							<div class="col-md-4">
								<input type="text" name="ville" value="<?php echo !empty($ville) ? $ville:'';?>" placeholder="Ville" class="form-control input-md" requierd/>
									<?php if (!empty($villeError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $villeError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($cpError)?'error':'';?>">
							<label class="col-md-4 control-label" for="cp">Code Postale</label>  
							<div class="col-md-4">
								<input type="text" name="cp" value="<?php echo !empty($cp) ? $cp:'';?>" placeholder="Code Postale" class="form-control input-md" requierd/>
									<?php if (!empty($cpError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $cpError;?></span></div>
									<?php endif;?>
							</div>
						</div>
					</fieldset>
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
								<input type="password" name="mdp" value="" placeholder="Mot de passe" class="form-control input-md" requierd/>
									<?php if (!empty($mdpError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $mdpError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($mdpConfError)?'error':'';?>">
							<label class="col-md-4 control-label" for="mdpConf">Confirmer Mot de passe</label>  
							<div class="col-md-4">
								<input type="password" name="mdpConf" value="" placeholder="Confirmer mot de passe" class="form-control input-md" requierd/>
									<?php if (!empty($mdpConfError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $mdpConfError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend></legend>
						<!-- Button (Double) -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="submit"></label>
							<div class="col-md-8">
								<input type="submit" name="submit" value="Valider" class="btn btn-success"/>
								<a class="btn btn-danger" href="login.php">Retour</a>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</section>
		<br />
		<br />
		<br />
	</body>
</html>

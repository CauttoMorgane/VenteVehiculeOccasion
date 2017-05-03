<?php
	session_start();
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");
	
	if ( null==$id ) {
		header("Location:login.php");
	}
	if ( $lvl!=2 ) {
		header("Location:membre.php");
	}
	
	if (!empty($_GET['x'])) {
		$x = $_REQUEST['x'];
	}
	if ( null==$x ){ 
		header("Location:adminListeMembre.php");
	}
	
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

            // on initialise nos erreurs
			$login = '';
			$lvl = '';
            $nameError = '';
			$firstnameError='';
			$emailError ='';
			$telError ='';
			$fixeError ='';
			$villeError ='';
			$cpError ='';

            // On assigne nos valeurs
            $login = htmlentities(trim($_POST['login']));
            $lvl = htmlentities(trim($_POST['lvl']));
            $name = htmlentities(trim($_POST['name']));
			$firstname=htmlentities(trim($_POST['firstname']));
			$email = htmlentities(trim($_POST['email'])); 
			$tel=htmlentities(trim($_POST['tel']));
			$fixe=htmlentities(trim($_POST['fixe']));
			$ville=htmlentities(trim($_POST['ville']));
			$cp=htmlentities(trim($_POST['cp']));

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
            $firstnameError ='Merci d\'entrer un Prenom';
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
        if (empty($fixe)) {
            $fixeError = 'Merci d\'entrer un N° de telephone fixe';
            $valid = false;
        }else if(!preg_match("#^0[0-9]{9}$#",$fixe)){
			//#^0[1-79]([-. ]?[0-9]{2}){4}$#
            $fixeError = 'Please enter a valid phone';
            $valid = false;
        }
		if (empty($tel)) {
            $telError = 'Merci d\'entrer un N° de telephone';
            $valid = false;
        }else if(!preg_match("#^0[0-9]{9}$#",$tel)){
			//#^0[1-79]([-. ]?[0-9]{2}){4}$#
            $telError = 'Please enter a valid phone';
            $valid = false;
        }
		if(empty($ville)){
            $villeError ='Merci d\'entrer un Prenom';
            $valid = false;
        }else if (!preg_match("/^[\p{L}-]*$/",$ville)) {
            $villeError = "Only letters and white space allowed"; 
			$valid = false;
        } 
		if (empty($cp)) {
            $cpError = 'Merci d\'entrer un code postal';
            $valid = false;
        }else if(!preg_match("#^[0-9][1-9]([0-9]{3})$#",$cp)){
            $cpError = 'Please enter a valid phone';
            $valid = false;
        }
            // mise à jour des donnés
        if ($valid) {
			$query=$db->prepare ("UPDATE auto_user 
									SET user_login = :login, user_lvl = :lvl, 
									user_nom = :name, user_prenom = :firstname,
									user_tel  = :tel, user_fixe = :fixe,
									user_cp = :cp, user_ville = :ville,
									user_mail = :email 
									WHERE user_id = ".$x."");
			$query->bindValue(':login',$login,PDO::PARAM_STR);
			$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
			$query->bindValue(':name',$name,PDO::PARAM_STR);
			$query->bindValue(':firstname',$firstname,PDO::PARAM_STR);
			$query->bindValue(':tel',$tel,PDO::PARAM_STR);
			$query->bindValue(':fixe',$fixe,PDO::PARAM_STR);
			$query->bindValue(':cp',$cp,PDO::PARAM_STR);
			$query->bindValue(':ville',$ville,PDO::PARAM_STR);
			$query->bindValue(':email',$email,PDO::PARAM_STR);
			$query->execute();
			$query->CloseCursor();
			header("Location: adminListeMembre.php");
        }
    }else {

		$query = $db->prepare ("SELECT * FROM auto_user WHERE user_id = ".$x."");
        $query->execute();
		
		while ($data = $query->fetch()){
			
			$login = $data['user_login'];
			$lvl = $data['user_lvl'];
			$name = $data['user_nom'];
			$firstname = $data['user_prenom'];
			$tel = $data['user_tel'];
			$fixe = $data['user_fixe'];
			$cp = $data['user_cp'];
			$ville = $data['user_ville'];
			$email = $data['user_mail'];
		}
    }  
?>
    	<div class="container">
			<hr>
			<div class="row">
				<div class="col-sm-8">
					<h2>Informations des membres<br />
						<small>Ici vous pouvez mettre à jour les données des membres.</small>
					</h2>
				</div>
			</div>
			<hr>
			<br />
			<form class="form-horizontal" method="post" action="adminUpdateMembre.php?x=<?php echo $x ;?>">
				<fieldset>
						<div class="form-group <?php echo !empty($loginError)?'error':'';?>">
							<label class="col-md-4 control-label" for="login">Login</label>  
							<div class="col-md-4">
								<input type="text" name="login" value="<?php echo !empty($login)?$login:'';?>" placeholder="Login" class="form-control input-md" requierd/>
									<?php if (!empty($loginError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $loginError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($lvlError)?'error':'';?>">
							<label class="col-md-4 control-label" for="name">LVL</label>  
							<div class="col-md-4">
								<input type="text" name="lvl" value="<?php echo !empty($lvl)?$lvl:'';?>" placeholder="Nom" class="form-control input-md" requierd/>
									<?php if (!empty($lvlError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $lvlError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
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
							<label class="col-md-4 control-label" for="firstname">Prenom</label>  
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
							<label class="col-md-4 control-label" for="fixe">Telephone Fixe</label>  
							<div class="col-md-4">
								<input type="text" name="fixe" value="<?php echo !empty($fixe) ? $fixe:'';?>" placeholder="Fixe" class="form-control input-md" requierd/>
									<?php if (!empty($fixeError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $fixeError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($telError)?'error':'';?>">
							<label class="col-md-4 control-label" for="tel">Telephone Portable</label>  
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
						<!-- Button (Double) -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="submit"></label>
							<div class="col-md-8">
								<input type="submit" name="submit" value="Valider" class="btn btn-success"/>
								<a class="btn btn-danger" href="adminListeMembre.php">Retour</a>
							</div>
						</div>
					</fieldset>
			</form>
		</div>
		<br />
		<br />
		<br />
    </body>
</html>
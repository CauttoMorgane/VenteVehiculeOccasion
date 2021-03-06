<?php
		session_start();
		include("includes/vSession.php");
		include("includes/debut.php");
		include("includes/function.php");
		
		if ( null==$id ) {
			header("Location:login.php");
		}
		
        if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){
    
       //on initialise nos messages d'erreurs;
        $marqueError = '';
        $modelError='';
        $kmError ='';
		$boiteError ='';
		$carbuError ='';
		$anneeError ='';
		$pxError ='';
		$descriError ='';
		$photoError ='';
		
        
        // on recupère nos valeurs 
        $marque = htmlentities(trim($_POST['marque']));
        $model= htmlentities(trim($_POST['model']));
        $km = htmlentities(trim($_POST['km'])); 
        $boite = htmlentities(trim($_POST['boite']));
        $carbu = htmlentities(trim($_POST['carbu']));
        $annee = htmlentities(trim($_POST['annee']));
        $px = htmlentities(trim($_POST['px']));
        $descri = htmlentities(trim($_POST['descri']));

        // on vérifie nos champs
        $valid = true;
        if (empty($marque)){
            $marqueError = 'Merci d\'entrer la marque';
            $valid = false;
        }else if (!preg_match("/^[\p{L}- ]*$/",$marque)) {
            $marqueError = "Chiffres non autorisés"; 
			$valid = false;
        }
        
		if(empty($model)){
            $modelError ='Merci d\'entrer le model';
            $valid= false;
        } 
        
		if (empty($km)){
            $kmError = 'Merci d\'entrer le nombre de kilomètre';
            $valid = false;
        }else if(!preg_match("/^[0-9]*$/",$km)){
            $kmError = 'Seul les chiffres sont autorisés';
            $valid = false;
        }
		
		if (empty($boite)) {
            $boiteError = 'Merci de sélectionner une boîte de vitesses';
            $valid = false;
        }
		
		if (empty($carbu)) {
            $carbuError = 'Merci de sélectionner un carburant';
            $valid = false;
        }
		
		if (empty($annee)) {
            $anneeError = 'Merci de sélectionner une année';
            $valid = false;
        }
		
		if (empty($px)){
            $pxError = 'Merci d\'entrer le prix de vente';
            $valid = false;
        }else if(!preg_match("/^[0-9]*$/",$px)){
            $pxError = 'Seul les chiffres sont autorisés';
            $valid = false;
        }
		
		if (empty($descri)) {
            $descriError = 'Merci entrer une description ';
            $valid = false;
        }
		
		if (!empty($_FILES['photo']['size']))
		{
			//On définit les variables :
			$maxsize = 2050000; //Poid de l'image
			$maxwidth = 130000; //Largeur de l'image
			$maxheight = 130000; //Hauteur de l'image
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' ); //Liste des extensions valides
			
			if ($_FILES['photo']['error'] > 0)
			{
					$photo_erreur = "Erreur lors du transfert de la photo : ";
			}
			if ($_FILES['photo']['size'] > $maxsize)
			{
					$photoError = "Le fichier est trop gros : (<strong>".$_FILES['photo']['size']." Octets</strong> contre <strong>".$maxsize." Octets</strong>)";
					$valid = false;
			}

			$image_sizes = getimagesize($_FILES['photo']['tmp_name']);
			if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
			{
					$photoError = "Image trop large ou trop longue : 
					(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
					$valid = false;
			}
			$extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
			if (!in_array($extension_upload,$extensions_valides) )
			{
					$photoError = "Extension de la photo incorrecte";
					$valid = false;
			}
		}
		
        // si les données sont présentes et bonnes, on se connecte à la base
        if ($valid) {
			$nomphoto=(!empty($_FILES['photo']['size']))?move_photo($_FILES['photo']):'';
			$query=$db->prepare("INSERT INTO auto_vehicule (vehicule_marque, vehicule_modele, vehicule_km,
															vehicule_boite, vehicule_carburant, vehicule_annee, 
															vehicule_pxVente, vehicule_description, vehicule_photo, 
															vehicule_vendeur, vehicule_dateCrea) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $query->execute(array($marque, $model, $km, $boite, $carbu, $annee, $px, $descri, $nomphoto, $id));
            header("Location:membreGererAnnonce.php");
        }
    }
?>
		<section>
			<div class="container">
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h1 class="section-heading">Ajouter une annonce</h1>
						<p class="lead section-lead">M2LOccasion site de vente de véhicule d'Occasion.</p>
						<p class="section-paragraph">Ici vous pouvez ajouter une annonce afin de vendre vos véhicules d'occasions.</p>
					</div>
				</div>
			</div>	
			
			<div class="container">
				<br />
				<form class="form-horizontal" method="post" enctype="multipart/form-data" action="addAnnonce.php">
					<fieldset>
						<legend></legend>
						<div class="form-group <?php echo !empty($marqueError)?'error':'';?>">
							<label class="col-md-4 control-label" for="marque">Marque</label>  
							<div class="col-md-4">
								<input type="text" name="marque" value="<?php echo !empty($marque)?$marque:'';?>" placeholder="Marque du véhicule" class="form-control input-md" requierd/>
									<?php if (!empty($marqueError)):?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $marqueError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($modelError)?'error':'';?>">
							<label class="col-md-4 control-label" for="model">Model</label>  
							<div class="col-md-4">
								<input type="text" name="model" value="<?php echo !empty($model)?$model:''; ?>" placeholder="Model du véhicule" class="form-control input-md"requierd/>
									<?php if(!empty($modelError)):?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $modelError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($kmError)?'error':'';?>">
							<label class="col-md-4 control-label" for="km">Kilométrage</label>  
							<div class="col-md-4">
								<input type="text" name="km" value="<?php echo !empty($km)?$km:'';?>" placeholder="Kilométrage du véhicule" class="form-control input-md" requierd/>
									<?php if(!empty($kmError)):?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $kmError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($boiteError)?'error':'';?>">
							<label class="col-md-4 control-label" for="boite">Boîte de vitesses</label>
							<div class="col-md-4">
								<select name="boite" class="form-control">
									<option value="">---------</option>
									<option value="Manuelle">Manuelle</option>
									<option value="Automatique">Automatique</option>
								</select>
									<?php if (!empty($boiteError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $boiteError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($carbuError)?'error':'';?>">
							<label class="col-md-4 control-label" for="carbu">Carburant</label>
							<div class="col-md-4">
								<select name="carbu" class="form-control">
									<option value="">---------</option>
									<option value="Essence">Essence</option>
									<option value="Diesel">Diesel</option>
									<option value="Hybride">Hybride</option>
									<option value="Electrique">Electrique</option>
								</select>
									<?php if (!empty($carbuError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $carbuError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($anneeError)?'error':'';?>">
							<label class="col-md-4 control-label" for="annee">Année</label>  
							<div class="col-md-4">
								<select name="annee" class="form-control">
									<option value="">---------</option>
<?php
									$i;
									for ($i = 1990; $i <= 2017 ; $i++)
									{
										echo'<option value="'.$i.'">'.$i.'</option>';
									}
?>
								</select>
									<?php if (!empty($anneeError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $anneeError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($pxError)?'error':'';?>">
							<label class="col-md-4 control-label" for="px">Prix de vente</label>  
							<div class="col-md-4">
								<input type="text" name="px" value="<?php echo !empty($px) ? $px:'';?>" placeholder="Prix de vente du véhicule" class="form-control input-md" requierd/>
									<?php if (!empty($pxError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $pxError;?></span></div>
									<?php endif;?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($descriError)?'error':'';?>">
							<label class="col-md-4 control-label" for="descri">Description</label>  
							<div class="col-md-4">
								<textarea name="descri" class="form-control"><?php echo !empty($descri)?$descri:'';?></textarea>
									<?php if (!empty($descriError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $descriError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
						<div class="form-group <?php echo !empty($photoError)?'error':'';?>">
							<label class="col-md-4 control-label" for="photo">Photo</label>
							<div class="col-md-4">
								<input type="file" id="photo" name="photo" value="" class="input-file" requierd/>
									<?php if (!empty($photoError)): ?>
										<div class="alert alert-danger" role="alert"><span class="help-inline"><?php echo $photoError;?></span></div>
									<?php endif; ?>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend></legend>
						<div class="form-group">
							<label class="col-md-4 control-label" for="submit"></label>
							<div class="col-md-8">
								<input type="submit" name="submit" value="Valider" class="btn btn-success"/>
								<a class="btn btn-danger" href="membre.php">Retour</a>
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

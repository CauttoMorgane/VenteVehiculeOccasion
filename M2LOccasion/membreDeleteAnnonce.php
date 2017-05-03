<?php
	session_start();
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");
	
	if (!empty($_GET['x'])) {
		$x = $_REQUEST['x'];
	}
	if ( null==$x ) {
		header("Location:membreGererAnnonce.php");
	}
	
	if(!empty($_POST)){
		$x= $_POST['x'];
		$query = $db->prepare ("DELETE FROM auto_vehicule 
								WHERE vehicule_vendeur = ".$id."
								AND vehicule_id = ".$x."");
		$query->execute();
		$query->closeCursor();
		header("Location:membreGererAnnonce.php");
	}
	
	if ( null==$x ) {
		header("Location:membreGererAnnonce.php");
	}
	
	if ( null==$id ) {
		header("Location:login.php");
	} 
	
	if ( $lvl==2 ) {
		header("Location:admin.php");
	}
?>
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h1>M2LOccasion
						<small>Supprimer</small>
					</h1>
				</div>
			</div><!--fin row-->
			<hr>
			<div class="row">
				<h3>Etes-vous sur de vouloir supprimer cette annonce ?</h3>
					<div class="container-fluid">
<?php
					$query = $db->prepare ("SELECT vehicule_marque, vehicule_modele, vehicule_photo 
											FROM auto_vehicule 
											WHERE vehicule_vendeur = ".$id."
											AND vehicule_id = ".$x."");
					$query->execute();
							
					while ($data = $query->fetch()){
						
						echo'
						
						
						<div class="row">
						  <div class="ofsetcol-sm-4 col-sm-6 col-md-4">
							<div class="thumbnail">
							<img id="img2" class="media-object" src="includes/photosAnnonces/'.$data['vehicule_photo'].'"alt="Image non disponible"/>
							  <div class="caption">
								<h3>'.stripslashes(htmlspecialchars($data['vehicule_marque'])).'</h3>
								<p>'.stripslashes(htmlspecialchars($data['vehicule_modele'])).'</p>
							 </div>
							</div>
						  </div>
						</div>
						';
					}
					$query->closeCursor();
?>					
					<form class="form-horizontal" method="post" action="membreDeleteAnnonce.php">
						<input type="hidden" name="x" value="<?php echo $x;?>"/>
						<legend></legend>
						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-6">
								<button type="submit" class="btn btn-lg btn-success">Oui</button>
								<a class="btn btn-lg btn-danger" href="membreGererAnnonce.php">Non</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />
	</body>
</html>
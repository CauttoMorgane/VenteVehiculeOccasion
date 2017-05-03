<?php
	include("includes/debut.php");

	$id=$_GET['id'];
?>
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">			
<?php
					$query=$db->query("SELECT *
									   FROM auto_user
									   INNER JOIN auto_vehicule ON auto_user.user_id = auto_vehicule.vehicule_vendeur
									   WHERE vehicule_id = '".$id."'");
					
						while ($data = $query->fetch())
							  {
								echo'
								<h1>Annonce n°'.stripslashes(htmlspecialchars($data['vehicule_id'])).'</h1>
								<hr>
									<img id="img2" class="img-responsive" src="includes/photosAnnonces/'.$data['vehicule_photo'].'"alt="Image non disponible"/>
								<br />
								<div class="caption-full">
									<h2 class="pull-right">'.stripslashes(htmlspecialchars($data['vehicule_pxVente'])).' €</h2>
									<h1><a href="#">'.stripslashes(htmlspecialchars($data['vehicule_marque'])).' '.stripslashes(htmlspecialchars($data['vehicule_modele'])).'</a></h1>
									<br />
									<p><blockquote>'.$data['vehicule_description'].'</blockquote></p>								
								</div>
								<table class="table table-responsive table-striped">
									<tr>
										<td>Année</td>
										<td>'.stripslashes(htmlspecialchars($data['vehicule_annee'])).'</td>
									</tr>
									<tr>
										<td>Kilométrage</td>
										<td>'.stripslashes(htmlspecialchars($data['vehicule_km'])).' Km</td>
									</tr>
									<tr>
										<td>Carburant</td>
										<td>'.stripslashes(htmlspecialchars($data['vehicule_carburant'])).'</td>
									</tr>
									<tr>
										<td>Boite de vitesse</td>
										<td>'.stripslashes(htmlspecialchars($data['vehicule_boite'])).'</td>
									</tr>
									<tr>
										<td>Localisation</td>
										<td>'.stripslashes(htmlspecialchars($data['user_cp'])).' '.stripslashes(htmlspecialchars($data['user_ville'])).'</td>
									</tr>
									
								</table>							
									  ';
							  }

							$query->closeCursor();
?>
				</div><!--fin col-md-12-->
			</div><!--fin row-->
			<br /><br />
			<div class="row">		
				<div class="alert alert-info" role="alert">
					<h2>Cette annonce vous intéresse ?</h2>
					<h3> Contactez l'annonceur ! </h3>
					<p class="text-center">
<?php
					$query = $db->prepare("SELECT *
										   FROM auto_user
										   INNER JOIN auto_vehicule ON auto_user.user_id = auto_vehicule.vehicule_vendeur
										   WHERE vehicule_id = '".$id."'");
					$query->execute();	
					
					while ($data = $query->fetch())
						{
							
							echo '
								<strong>'.stripslashes(htmlspecialchars($data['user_nom'])).' '.stripslashes(htmlspecialchars($data['user_prenom'])).'</strong>
								<br /><span class="glyphicon glyphicon-home" aria-hidden="true"></span> : <a href="tel:'.stripslashes(htmlspecialchars($data['user_fixe'])).'">'.stripslashes(htmlspecialchars($data['user_fixe'])).'</a>
								<br /><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> : <a href="tel:'.stripslashes(htmlspecialchars($data['user_tel'])).'">'.stripslashes(htmlspecialchars($data['user_tel'])).'</a>
								<br /><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> : <a href="mailto:'.stripslashes(htmlspecialchars($data['user_mail'])).'">'.stripslashes(htmlspecialchars($data['user_mail'])).'</a>
							</p>
							';
						}
					$query->CloseCursor();					
?>					
					<br /><br />
				</div>
			</div><!--fin row-->
			<br /><br />
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<a id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg btn-block" href="index.php">Retour</a>
				</div>
			</div><!--fin row-->
		</div><!--fin container-->
		<br />
		<br />
		<br />
	</body>
</html>

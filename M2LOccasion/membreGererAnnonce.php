<?php
	session_start();
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");
		
	if ( null==$id ) {
		header("Location:login.php");
	}
	if ( $lvl==2 ) {
		header("Location:adminGererAnnonce.php");
	}
?>
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h1 >Véhicule
						<small>Occasion</small>
					</h1>
				</div>
			</div><!--fin row-->
			<hr>
			<div class="row">
				<br />
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<th>Photo</th>
							<th>Marque</th>
							<th>Modele</th>
							<th>Kilometrage</th>
							<th>Boite</th>
							<th>Carburant</th>
							<th>Année</th>
							<th>Prix</th>
						</thead>
						
						<tbody>
							<?php
								$query = $db->prepare("SELECT * FROM auto_vehicule
													   WHERE vehicule_vendeur = '$id'
													   ORDER BY vehicule_marque");
								$query->execute();

								if ($query->rowCount() > 0)
								{
									   //On lance la boucle
									   
									   while ($data = $query->fetch())
									   {
											echo'<tr>';
												echo'<td><img class="img-responsive" src="includes/photosAnnonces/'.$data['vehicule_photo'].'"alt="Image non disponible" width="100" height="100"/>
													<td>'.$data['vehicule_marque'].'</td>
													<td>'.$data['vehicule_modele'].'</td>
													<td>'.$data['vehicule_km'].'</td>
													<td>'.$data['vehicule_boite'].'</td>
													<td>'.$data['vehicule_carburant'].'</td>
													<td>'.$data['vehicule_annee'].'</td>
													<td>'.$data['vehicule_pxVente'].'</td>
													<td>
														<a class="btn btn-success" href="membreUpdateAnnonce.php?x='.$data['vehicule_id'].'">Mettre à jour</a>
													</td>
													<td>
														<a class="btn btn-danger" href="membreDeleteAnnonce.php?x='.$data['vehicule_id'].'">Supprimer</a>
													</td>
												</tr>';
										}
								}
								$query->CloseCursor();
							?>    
						</tbody>
					</table>
				</div>
				<div class="col-md-offset-3 col-md-6 col-md-offset-3">
					<a class="btn btn-primary btn-block" href="membre.php">Retour</a>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />
    </body>
</html>
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
?>
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h1>Membres
						<small>Gestion</small>
					</h1>
				</div>
			</div><!--fin row-->
			<hr>
			<div class="row">
				<br />
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<th>Nom</th>
							<th>Prénom</th>
							<th>E Mail</th>
							<th>Fixe</th>
							<th>Portable</th>
							<th>Ville</th>
						</thead>
						
						<tbody>
							<?php
								$query = $db->prepare("SELECT user_id, user_nom, user_prenom, user_mail, user_fixe, user_tel, user_ville FROM auto_user");
								$query->execute();

								if ($query->rowCount() > 0)
								{
									   //On lance la boucle
									   
									   while ($data = $query->fetch())
									   {
											echo'<tr>';
												echo'<td>'.$data['user_nom'].'</td>';
												echo'<td>'.$data['user_prenom'].'</td>';
												echo'<td>'.$data['user_mail'].'</td>';
												echo'<td>'.$data['user_fixe'].'</td>';
												echo'<td>'.$data['user_tel'].'</td>';
												echo'<td>'.$data['user_ville'].'</td>';
												echo'<td>';
													echo '<a class="btn btn-warning" href="adminUpdateMembre.php?x='.$data['user_id'].'">Mettre à jour</a>';// un autre td pour le bouton d'update
												echo'</td>';
												echo'<td>';
													echo '<a class="btn btn-danger" href="adminDeleteMembre.php?x='.$data['user_id'].'">Supprimer</a>';// un autre td pour le bouton de suppression
												echo'</td>';
											echo'</tr>';
										}
								}
								$query->CloseCursor();
							?>    
						</tbody>
					</table>
				</div>
			</div><!--fin row-->
			<div class="row">
				<div class="col-md-12">
					<a class="btn btn-success btn-block" href="admin.php">Retour</a>
				</div>
			</div><!--fin row-->
		</div><!--fin container-->
		<br />
		<br />
		<br />
    </body>
</html>
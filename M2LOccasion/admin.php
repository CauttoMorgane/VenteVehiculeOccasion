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
				<div class="col-sm-8">
					<h2>Compte Administrateur</h2>
					<p>Introduce the visitor to the business using clear, informative text. Use well-targeted keywords within your sentences to make sure search engines can find the business.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et molestiae similique eligendi reiciendis sunt distinctio odit? Quia, neque, ipsa, adipisci quisquam ullam deserunt accusantium illo iste exercitationem nemo voluptates asperiores.</p>
				</div>
			</div><!--fin row-->

			<hr>

			<div class="row">
				<div class="col-sm-3">
					<a href="infoUpdate.php"><img class="img-circle img-responsive img-center" src="./includes/images/profilAdmin.jpg" alt="Information"></a>
					<h2>Info Administrateur</h2>
				</div>
				<div class="col-sm-3">
					<a href="adminListeMembre.php"><img class="img-circle img-responsive img-center" src="./includes/images/compteAdmin.jpg" alt="Information"></a>
					<h2>Gérer Membres</h2>
				</div>
				<div class="col-sm-3">
					<a href="adminGererAnnonce.php"><img class="img-circle img-responsive img-center" src="./includes/images/gererAdmin.jpg" alt="Gerer"></a>
					<h2>Gérer Annonces</h2>
				</div>
				<div class="col-sm-3">
					<a href="addAnnonce.php"><img class="img-circle img-responsive img-center" src="./includes/images/annonceAdmin.jpg" alt="Annonce"></a>
					<h2>Ajouter Annonce</h2>
				</div>
			</div><!--fin row-->
			
			<br />
			<br />
			<br />
			<div class="row">
					<div class="col-sm-12">
						<a href="logout.php" class="btn btn-warning btn-lg btn-block" role="button">Déconnexion</a>
				</div>
		</div><!--fin container-->
		
		</div>	
		<br />
		<br />
		<br />
		<br />
	</body>
</html>

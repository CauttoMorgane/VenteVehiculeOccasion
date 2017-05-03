<?php
	session_start();
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");
		
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
				<div class="col-sm-8">
					<h2>Mon Compte</h2>
					<p>Introduce the visitor to the business using clear, informative text. Use well-targeted keywords within your sentences to make sure search engines can find the business.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et molestiae similique eligendi reiciendis sunt distinctio odit? Quia, neque, ipsa, adipisci quisquam ullam deserunt accusantium illo iste exercitationem nemo voluptates asperiores.</p>
				</div>
				<div class="col-sm-4">
					<h2>Un problème ?</h2>
					<h4>Contactez nous :</h4>
					<address>
						<strong>M2L</strong>
						<br>3481 Melrose Place
						<br>Beverly Hills, CA 90210
						<br>
					</address>
					<address>
						<abbr title="Phone"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></abbr> <a href="tel:#">06.16.71.38.00</a>
						<br>
						<abbr title="Email"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></abbr> <a href="mailto:#">toto@gmail.com</a>
					</address>
				</div>
			</div><!--fin row-->

			<hr>

			<div class="row">
				<div class="col-sm-4">
					<a href="infoUpdate.php"><img class="img-circle img-responsive img-center" src="./includes/images/compte.jpg" alt="Information"></a>
					<h2>Mes Informations</h2>
				</div>
				<div class="col-sm-4">
					<a href="addAnnonce.php"><img class="img-circle img-responsive img-center" src="./includes/images/annonce.jpg" alt="Annonce"></a>
					<h2>Ajouter une Annonce</h2>
				</div>
				<div class="col-sm-4">
					<a href="membreGererAnnonce.php"><img class="img-circle img-responsive img-center" src="./includes/images/gerer.jpg" alt="Gerer"></a>
					<h2>Gérer mes Annonces</h2>
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
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
	</body>
</html>

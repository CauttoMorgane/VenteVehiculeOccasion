<?php
	session_start();
	
	include("includes/vSession.php");
	include("includes/debut.php");
	include("includes/function.php");

	
	session_destroy();
	
	header("Location:login.php");

?>
<!--
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h1>M2LOccasion
						<small>Déconnexion</small>
					</h1>
				</div>
			</div>
			<legend></legend>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="container-fluid">	
						<h2>Vous êtes à présent déconnecté </h2><br />
						<div class="col-md-6 col-md-offset-3">
							<a class="label label-info" href="login.php">Cliquez ici pour vous connecter</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<br />
		<br />
		<br />
	</body>
</html>
-->


<?php
	include("includes/debut.php");
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
				<div class="jumbotron">
					<h2>Que cherchez-vous ?</h2>
					<form class="form-horizontal" method="POST" action="recherche.php">
						<fieldset>
							<legend></legend>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<select id="selectbasic" name="marque" class="form-control">
											<option value="NULL" selected>Marque</option>
											<option value="Alfa romeo">Alfa Romeo</option>
											<option value="Audi">Audi</option>
											<option value="Mercedes">Mercedes</option>
											<option value="Peugeot">Peugeot</option>
											<option value="Renault">Renault</option>
											<option value="Volkswagen">Volkswagen</option>
										</select>
									</div>
								</div>
								<br />
								<div class="row"> 
									<div class="col-md-6">
										<select id="selectbasic" name="kmMin" class="form-control">
											<option value="0" selected>Km minimum </option>
<?php
											$i;
											for ($i = 0; $i <= 750000 ; $i+=5000)
											{
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
?>
										</select>
									</div>
									<div class="col-md-6">
										<select id="selectbasic" name="kmMax" class="form-control">
											<option value="750001" selected>Km Maximum</option>
<?php
											$i;
											for ($i = 0; $i <= 750000 ; $i+=5000)
											{
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
?>
										</select>
									</div>
								</div>
								<br />
								<div class="row"> 
									<div class="col-md-6">
										<select id="selectbasic" name="anneeMin" class="form-control">
											<option value="1990" selected>Année minimum</option>
<?php
											$i;
											for ($i = 1990; $i <= 2017 ; $i++)
											{
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
?>
										</select>
									</div>
									<div class="col-md-6">
										<select id="selectbasic" name="anneeMax" class="form-control">
											<option value="2017" selected>Année maximum</option>
<?php
											$i;
											for ($i = 1990 ; $i <= 2017 ; $i++)
											{
												echo'<option value="'.$i.'">'.$i.'</option>';
											}
?>
										</select>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-6">
										<select id="selectbasic" name="pxMin" class="form-control">
											<option value="0" selected>Prix minimum</option>
<?php
											$i;
											for ($i = 0; $i <= 25000 ; $i+=500)
											{
												echo'<option value="'.$i.'">'.$i.' €</option>';
											}
?>
										</select>
									</div>
									<div class="col-md-6">
										<select id="selectbasic" name="pxMax" class="form-control">
											<option value="25001" selected>Prix maximum</option>
<?php
											$i;
											for ($i = 0; $i <= 25000 ; $i+=500)
											{
												echo'<option value="'.$i.'">'.$i.' €</option>';	
											}
?>
										</select>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-offset-4 col-md-6">
										<input type="submit" value=" Valider " id="button1id" name="button1id" class="btn btn-success btn-lg"/>
										<input type="reset" value="Annuler" id="button2id" name="button2id" class="btn btn-danger btn-lg"/>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div><!--fin jumbotron-->
			</div><!--fin row-->		
<?php

				//A partir d'ici, on va compter le nombre de members
					//pour n'afficher que les 5 premiers
					$query=$db->query('SELECT COUNT(*) AS nbr FROM auto_vehicule');
					$data = $query->fetch();

					$total = $data['nbr'] +1;
					$query->CloseCursor();
					$MembreParPage = 5;
					$NombreDePages = ceil($total / $MembreParPage);

					//Nombre de pages

					$page = (isset($_GET['page']))?intval($_GET['page']):1;

					//On affiche les pages 1-2-3, etc.
							echo '<nav>
									<div class="row text-center">
										<div class="col-md-12">
											<ul class="pagination">';
												for ($i = 1 ; $i <= $NombreDePages ; $i++)
												{
													if ($i == $page) //On ne met pas de lien sur la page actuelle
														{
															echo '<li><a href="#">'.$i.'</a></li>';
														}
														else
														{
															echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
														}
												}
											echo '
											</div>
										</div>
									</ul>
								</nav>';

					$premier = ($page - 1) * $MembreParPage;
					
					//Requête
					$query = $db->prepare("SELECT * FROM auto_vehicule
											ORDER BY vehicule_dateCrea
											LIMIT :premier, :membreparpage");
					$query->bindValue(':premier',$premier,PDO::PARAM_INT);
					$query->bindValue(':membreparpage',$MembreParPage, PDO::PARAM_INT);
					$query->execute();

					if ($query->rowCount() > 0)
					{
						   //On lance la boucle
						   
						   while ($data = $query->fetch())
						   {
							   echo '
							   
								<div class="row">
									<div class="col-md-7">
										<a href="#">
											<img id="img1" class="img-responsive" src="includes/photosAnnonces/'.$data['vehicule_photo'].'"alt="Image non disponible" width="600" height="500"/>											
										</a>
									</div>
									<div class="col-md-5">
										<h3>'.stripslashes(htmlspecialchars($data['vehicule_marque'])).'</h3>
										<h4>'.stripslashes(htmlspecialchars($data['vehicule_modele'])).'</h4>
										<p>Année '.stripslashes(htmlspecialchars($data['vehicule_annee'])).'
										<br />'.stripslashes(htmlspecialchars($data['vehicule_km'])).' Km
										<br /><b>'.stripslashes(htmlspecialchars($data['vehicule_pxVente'])).' €</b></p>
										<a class="btn btn-primary" href="consulter.php?id='.$data['vehicule_id'].'">Voir plus<span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>
								</div><!-- /.row -->

								<hr>';
						   }
					}				
							//Nombre de pages

							$page = (isset($_GET['page']))?intval($_GET['page']):1;

							//On affiche les pages 1-2-3, etc.
							echo '<nav>
									<div class="row text-center">
										<div class="col-md-12">
											<ul class="pagination">';
												for ($i = 1 ; $i <= $NombreDePages ; $i++)
												{
													if ($i == $page) //On ne met pas de lien sur la page actuelle
														{
															echo '<li><a href="#">'.$i.'</a></li>';
														}
														else
														{
															echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
														}
												}
											echo '
											</div>
										</div>
									</ul>
								</nav>';
							$premier = ($page - 1) * $MembreParPage;		

	 $query->CloseCursor();						
?>
		<br />
		<br />
		<br />
	</body>
</html>

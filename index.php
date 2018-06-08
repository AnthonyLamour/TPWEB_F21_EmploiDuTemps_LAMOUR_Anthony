<!DOCTYPE html>
<html>

	<head>

		<!--encodage de la page-->
			<meta charset="utf-8"/>
		<!--icone de la page-->
			<link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />
		<!--titre de la page-->
			<title>Page d'acceuille</title>
		<!--liaison à la feuille de style-->
			<link rel="stylesheet"type="text/css"href="style.css">

	</head>

	<body>

		<!--menu de navigation de la page-->
			<nav>
				<ul>
					<p>Menu :</p>
					<li><a href="index.php" title="Home">Page d'acceuille</a></li>
				</ul>
			</nav>

		<!--Grand titre de la page-->
			<header>

				<h1>Page d'acceuille :</h1>
				
			</header>

		<!--section formulaire d'insertion-->
			<section>

				<!--titre de la section formulaire d'insertion-->
					<aside>
						
						<br><h2>Formulaire d'insetion:</h2>
						
					</aside>

				<!--contenu de la section formulaire d'insertion-->
					<article>

						<!--formulaire d'insertion-->
							<form name="FormulaireAcceuille" id="FormulaireAcceuille" method="POST" ACTION=Formulaire.php><br>

								<!--sélection de la future table à remplir-->
									<p>Quelle table voulez-vous remplir ?<p><br>
									
									<select name="NomTable" id="NomTable" >

										<option value="eleve" >Elève</option>
										<option value="enseignant" >Enseignant</option>
										<option value="enseignement" >Enseignement</option>
										<option value="classe" >Classe</option>
										<option value="niveau" >Niveau</option>
										<option value="matiere" >Matière</option>
										<option value="salle" >Salle</option>
										<option value="typec" >Type de cours</option>
										<option value="cours" >Cours</option>
										<option value="tranchehoraire" >Tranche horaire</option>

									</select><br><br>
								
								<!--nombre de ligne à remplir-->
									<p>Combien de lignes voulez-vous ajouter ?<p><br>
									
									<input type=number name="Nombre" id="Nombre" value=0 required>

								<!--bouton envoyer-->
									<br><br><input name="Envoyer" id="Envoyer" type=submit />

							</form>

					</article>

			</section>
		
		<!--section formulaire d'affichage de l'emploi du temps-->
			<section>

				<!--titre de la section formulaire d'affichage-->
					<aside>
						
						<br><h2>Formulaire d'affichage:</h2>
						
					</aside>

				<!--contenu de la section formulaire d'insertion-->
					<article>

						<!--formulaire d'affichage-->
							<form name="FormulaireAcceuille2" id="FormulaireAcceuille2" method="POST" ACTION=emploi_du_temp.php><br>

								<!--sélection de l'élève dont on veux afficher l'emploi du temps-->
									<p>Selectionnez un élève :<p><br>
								
									<select name="MAILEL" id="MAILEL" >

										<?php

											require('connect.php');

											$connexion=ConnecServ();

											$sql="SELECT MAILEL, NOMEI, PRENOMEI
												  from ELEVE
												  order by NOMEI asc";
											foreach($connexion->query($sql) as $row){
												echo "<option value=\"".$row['MAILEL']."\">".$row['NOMEI']." ".$row['PRENOMEI']."</option>";
											}

										?>

									</select>

								<!--bouton envoyer-->
									<br><br><input name="Envoyer2" id="Envoyer2" type=submit />

							</form>

					</article>

			</section>
		
		<!--footer de la page avec logo ludus et copyright-->
			<footer>

				<br>
				<img id="logo" src="image/logo.jpg"/><p>Copyright LUDUS - Tous droits réservés<br/>

			</footer>

	</body>

</html>
<!DOCTYPE html>
<html>

	<head>

		<!--encodage de la page-->
			<meta charset="utf-8"/>
		<!--icone de la page-->
			<link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />
		<!--titre de la page-->
			<title>Formulaire</title>
		<!--liaison à la feuille de style-->
			<link rel="stylesheet"type="text/css"href="style.css">

	</head>

	<body>

		<!--menu de navigation de la page-->
			<nav>
				<ul>
					<p>Menu :</p>
					<li><a href="index.php" title="Home">Page d'acceuille</a></li>
					<li><a href="Formulaire.php" title="Formulaire">Formulaire</a></li>
				</ul>
			</nav>

		<!--Grand titre de la page-->
			<header>

				<h1>Formulaire :</h1>
				
			</header>

		<!--section de formulaire de la page ou d'insertion dans la base de données-->
			<section>

				<!--titre de la section-->
					<aside>
						
						<h2>Insertion :</h2>
						
					</aside>

				<!--contenu de la page-->
					<article>

							<?php
								
								//vérification que la variable contenant le nom de la table envoyé est set
									if (isset($_POST['NomTable'])){
										
										//si c'est le cas alors création d'une variable contenant le nom de la table 
											$NomTable=$_POST['NomTable'];
											
										//vérification que la variable contenant le nombre de lignes à remplir envoyé est set
											if (isset($_POST['Nombre'])){
												
												//vérification que le nombre est valide
													if ($_POST['Nombre']>0){
														
														//si c'est le cas alors connexion à la base de données
															require('connect.php');
															$connexion=ConnecServ();
														
														//création d'un formulaire
															echo "<form name=\"FormulaireInsertion\" id=\"FormulaireInsertion\" 
																  method=\"POST\" ACTION=Formulaire.php><br>";
														
														//création d'une variable contenant le nombre de lignes à remplir
															$Nombre=$_POST['Nombre'];
															
														//création d'une varible i permettant de construire le formulaire
															$i=0;
															
														//construction du formulaire
															for($i=1;$i<=$Nombre;$i++){
																
																//en fonction du nom de la table on construit le formulaire adapté
																	if($NomTable=='eleve'){
																		echo "<label for=\"MAILEL".$i."\">Mail de l'élève ".$i."</label>:<br><input type=\"text\" name=\"MAILEL".$i."\" id=\"MAILEL".$i."\" placeholder=\"e.exemple@ludus-academie.com\" required/><br>
																			  <label for=\"NOMC".$i."\">Classe de l'élève ".$i."</label>:<br><input type=\"text\" name=\"NOMC".$i."\" id=\"NOMC".$i."\" placeholder=\"E11\" required/><br>
																			  <label for=\"NOMEI".$i."\">Nom de l'élève ".$i."</label>:<br><input type=\"text\" name=\"NOMEI".$i."\" id=\"NOMEI".$i."\" placeholder=\"EXEMPLE\" required/><br>
																			  <label for=\"PRENOMEI".$i."\">Prénom de l'élève ".$i."</label>:<br><input type=\"text\" name=\"PRENOMEI".$i."\" id=\"PRENOMEI".$i."\" placeholder=\"Exemple\" required/><br><br>";
																	}else if($NomTable=='enseignant'){
																		echo "<label for=\"MAILE".$i."\">Mail de l'enseignant ".$i."</label>:<br><input type=\"text\" name=\"MAILE".$i."\" id=\"MAILE".$i."\" placeholder=\"e.exemple@ludus-academie.com\" required/><br>
																			  <label for=\"NOME".$i."\">Nom de l'enseignant ".$i."</label>:<br><input type=\"text\" name=\"NOME".$i."\" id=\"NOME".$i."\" placeholder=\"EXEMPLE\" required/><br>
																			  <label for=\"PRENOME".$i."\">Prénom de l'enseignant ".$i."</label>:<br><input type=\"text\" name=\"PRENOME".$i."\" id=\"PRENOME".$i."\" placeholder=\"Exemple\" required/><br><br>";
																	}else if($NomTable=='enseignement'){
																		echo "<p>Mail de l'enseignant :</p>
																			<select name=\"MAILE".$i."\" id=\"MAILE".$i."\" >";
																		$sql="SELECT MAILE
																			  from ENSEIGNANT
																			  order by MAILE asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['MAILE']."\">".$row['MAILE']."</option>";
																		}

																		echo "</select>";
																		
																		echo "<p>Nom de la matière :</p>
																			<select name=\"NOMM".$i."\" id=\"NOMM".$i."\" >";
																		$sql="SELECT NOMM
																			  from MATIERE
																			  order by NOMM asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMM']."\">".$row['NOMM']."</option>";
																		}

																		echo "</select>";
																	}else if($NomTable=='classe'){
																		echo "<p>Niveau de la classe :</p>
																			<select name=\"NOMNIV".$i."\" id=\"NOMNIV".$i."\" >";
																		$sql="SELECT NOMNIV
																			  from NIVEAU
																			  order by NOMNIV asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMNIV']."\">".$row['NOMNIV']."</option>";
																		}
																		echo "</select><br><br>";
																		echo "<label for=\"NOMC".$i."\">Nom de la classe ".$i."</label>:<br><input type=\"text\" name=\"NOMC".$i."\" id=\"NOMC".$i."\" placeholder=\"E11\" required/><br><br>";
																	}else if($NomTable=='niveau'){
																		echo "<label for=\"NOMNIV".$i."\">Niveau de la classe ".$i."</label>:<br><input type=\"text\" name=\"NOMNIV".$i."\" id=\"NOMNIV".$i."\" placeholder=\"E1\" required/><br><br>";
																	}else if($NomTable=='matiere'){
																		echo "<label for=\"NOMM".$i."\">Nom de la matière ".$i."</label>:<br><input type=\"text\" name=\"NOMM".$i."\" id=\"NOMM".$i."\" placeholder=\"EXEMPLE\" required/><br><br>";
																	}else if($NomTable=='salle'){
																		echo "<label for=\"NOMS".$i."\">Nom de la salle ".$i."</label>:<br><input type=\"text\" name=\"NOMS".$i."\" id=\"NOMS".$i."\" placeholder=\"EXEMPLE\" required/><br>
																			  <label for=\"LOGOS".$i."\">Nom du logo de la salle ".$i."</label>:<br><input type=\"text\" name=\"LOGOS".$i."\" id=\"LOGOS".$i."\" placeholder=\"Exemple\" required/><br><br>";
																	}else if($NomTable=='typec'){
																		echo "<label for=\"NOMT".$i."\">Nom du type de cours ".$i."</label>:<br><input type=\"text\" name=\"NOMT".$i."\" id=\"NOMT".$i."\" placeholder=\"EXEMPLE\" required/><br><br>";
																	}else if($NomTable=='cours'){
																		echo "<p>Matière :</p>
																			<select name=\"NOMM".$i."\" id=\"NOMM".$i."\" >";
																		$sql="SELECT NOMM
																			  from MATIERE
																			  order by NOMM asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMM']."\">".$row['NOMM']."</option>";
																		}

																		echo "</select>";
																		echo "<p>Mail de l'enseignant :</p>
																			<select name=\"MAILE".$i."\" id=\"MAILE".$i."\" >";
																		$sql="SELECT MAILE
																			  from ENSEIGNANT
																			  order by MAILE asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['MAILE']."\">".$row['MAILE']."</option>";
																		}

																		echo "</select>";
																		
																		echo "<p>Nom du la classe :</p>
																			<select name=\"NOMC".$i."\" id=\"NOMC".$i."\" >";
																		$sql="SELECT NOMC
																			  from CLASSE
																			  order by NOMC asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMC']."\">".$row['NOMC']."</option>";
																		}

																		echo "</select>";
																		
																		echo "<p>Nom du jour :</p>
																			<select name=\"NOMJ".$i."\" id=\"NOMJ".$i."\" >";
																		$sql="SELECT NOMJ
																			  from JOUR
																			  order by NOMJ asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMJ']."\">".$row['NOMJ']."</option>";
																		}

																		echo "</select>";
																		
																		echo "<p>Nom de la salle :</p>
																			<select name=\"NOMS".$i."\" id=\"NOMS".$i."\" >";
																		$sql="SELECT NOMS
																			  from SALLE
																			  order by NOMS asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMS']."\">".$row['NOMS']."</option>";
																		}

																		echo "</select>";
																		
																		echo "<p>Nom du type de cours :</p>
																			<select name=\"NOMT".$i."\" id=\"NOMT".$i."\" >";
																		$sql="SELECT NOMT
																			  from TYPEC
																			  order by NOMT asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['NOMT']."\">".$row['NOMT']."</option>";
																		}

																		echo "</select>";
																		echo "<p>tranche horaire :</p>
																			<select name=\"HDEBUT".$i."\" id=\HDEBUT".$i."\" >";
																		$sql="SELECT HDEBUT, HFIN
																			  from TRANCHEHORAIRE
																			  order by HDEBUT asc";
																		foreach($connexion->query($sql) as $row){
																			echo "<option value=\"".$row['HDEBUT']."-".$row['HFIN']."\">".$row['HDEBUT']."-".$row['HFIN']."</option>";
																		}

																		echo "</select>";
															
																	}else if($NomTable=="tranchehoraire"){
																		echo "<br><br><label for=\"HDEBUT".$i."\">Heure du début du cours ".$i."</label>:<br><input type=\"text\" name=\"HDEBUT".$i."\" id=\"HDEBUT".$i."\" placeholder=\"00h00\" required/><br>
																			  <br><br><label for=\"HFIN".$i."\">Heure de fin du cours ".$i."</label>:<br><input type=\"text\" name=\"HFIN".$i."\" id=\"HFIN".$i."\" placeholder=\"00h00\" required/><br>";
																	}
																
															}
															
														//sauvegade du nombre de ligne et du nom de la table à envoyé pour réaliser l'insertion
															echo "<input  type=\"hidden\" name=\"i\" id=\"i\" value=".$Nombre."  >";
															echo "<input  type=\"hidden\" name=\"NomTable\" id=\"NomTable\" value=".$NomTable."  >";
														
														//finalisation du formulaire
															echo "<br><br><input name=\"Envoyer\" id=\"Envoyer\" type=submit />

																</form>";
													}
													
										//vérification que la variable i est set
											}else if (isset($_POST['i'])){
												
												//si c'est le cas alors création d'une variable contenant i
													$i=$_POST['i'];
													
												//connexion à la base de données
													require('connect.php');
													$connexion=ConnecServ();
													
												//en fonction du nom de la table on réalise les insertions correspondante
													if ($NomTable=='eleve'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(MAILEL,NOMC,NOMEI,PRENOMEI)
																  values(\"".$_POST["MAILEL".$j]."\",\"".$_POST["NOMC".$j]."\",\"".$_POST["NOMEI".$j]."\",\"".$_POST["PRENOMEI".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='enseignant'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(MAILE,NOME,PRENOME)
																  values(\"".$_POST["MAILE".$j]."\",\"".$_POST["NOME".$j]."\",\"".$_POST["PRENOME".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='enseignement'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(MAILE,NOMM)
																  values(\"".$_POST["MAILE".$j]."\",\"".$_POST["NOMM".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='classe'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMNIV,NOMC)
																  values(\"".$_POST["NOMNIV".$j]."\",\"".$_POST["NOMC".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='niveau'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMNIV)
																  values(\"".$_POST["NOMNIV".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='matiere'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMM)
																  values(\"".$_POST["NOMM".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='salle'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMS,LOGOS)
																  values(\"".$_POST["NOMS".$j]."\",\"".$_POST["LOGOS".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='typec'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMT)
																  values(\"".$_POST["NOMT".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='cours'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(NOMM,MAILE,NOMC,HDEBUT,HFIN,NOMJ,NOMS,NOMT)
																  values(\"".$_POST["NOMM".$j]."\",\"".$_POST["MAILE".$j]."\",\"".$_POST["NOMC".$j]."\",\""
																  .substr($_POST["HDEBUT".$j],-11,5)."\",\"".substr($_POST["HDEBUT".$j],-5)."\",\"".$_POST["NOMJ".$j]."\",\""
																  .$_POST["NOMS".$j]."\",\"".$_POST["NOMT".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
														
													}else if ($NomTable=='tranchehoraire'){
														$j=0;
														for ($j=1;$j<=$i;$j++){
															$sql="insert into ".$NomTable."(HDEBUT,HFIN)
																  values(\"".$_POST["HDEBUT".$j]."\",\"".$_POST["HFIN".$j]."\");";
															$stmt=$connexion->prepare($sql);
															$stmt->execute();
														}
													}
													
												//information que l'utilisateur à bien inséré les données
													echo "<br><p>Votre insertion a été réussi!</p><br>";
											}
									}
								
							?>

					</article>

			</section>
		
		<!--footer de la page avec logo ludus et copyright-->
			<footer>

				<br>
				<img id="logo" src="image/logo.jpg"/><p>Copyright LUDUS - Tous droits réservés<br/>

			</footer>

	</body>

</html>
<!DOCTYPE html>
<html>

	<head>

		<!--encodage de la page-->
			<meta charset="utf-8"/>
		<!--icone de la page-->
			<link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />
		<!--titre de la page-->
			<title>Emploi du temps</title>
		<!--liaison à la feuille de style-->
			
			
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
			<link rel="stylesheet"type="text/css"href="style.css">
	</head>

	<body>

		<!--menu de navigation de la page-->
			<nav>
				<ul>
					<p>Menu :</p>
					<li><a href="index.php" title="Home">Page d'acceuille</a></li>
					<li><a href="emploi_du_temp.php" title="Emploi_du_temps">Emploi du temps</a></li>
				</ul>
			</nav>

		<!--Grand titre de la page-->
			<header>

				<h1>Emploi du temps :</h1>
				
			</header>

		<!--section emploi du temps-->
			<section>

				<!--titre de la section emploi du temps-->
					<aside>
					
						<h2>Emploi du temps de l'élève sélectionné :</h2>
						
					</aside>

				<!--contenu de la section emploi du temps-->
					<article>
					
						<?php
						
							//si le mail de l'élève envoyé est set
								if (isset($_POST['MAILEL'])){
									
									//si c'est le cas alors création d'une variable pour le stocker
										$MailEl=$_POST['MAILEL'];
									
									//création d'une variable classe
										$Classe;
										
									//création d'un compteur qui servira pour la construction du tableau
										$cpt=0;
										
									//connexion à la base de données
										require('connect.php');
										$connexion=ConnecServ();
										
									//création d'un sript permettant de récupérer la classe de l'élève
										$sql="SELECT DISTINCT NOMC
											  from ELEVE
											  WHERE MAILEL = \"".$MailEl."\";";
											  
									//exécution du script
										foreach($connexion->query($sql) as $row){
											//affichage de la classe de l'élève
												echo "<p>Classe de l'élève : ".$row['NOMC']."</p>";
											//insertion de la classe dans la variable créé plus tôt
												$Classe=$row['NOMC'];
										}
									
									//construction du tableau
										echo "<br>
												<table class=\"table table-dark\">
													<thead>
														<tr>
															<th> </th>";
										//création d'un script permettant de récupérer les horaires de cours de l'élève
											$sql="SELECT DISTINCT HDEBUT, HFIN 
												  from cours
												  where NOMC = \"".$Classe."\"
												  order by HDEBUT asc;";
										
										//création d'un tableau d'un tableau contenant ces horaires
											$Tab=array();
											foreach($connexion->query($sql) as $row){
												echo "<th>".$row['HDEBUT']."-".$row['HFIN']."</th>";
												$Tab[$cpt]="".$row['HDEBUT']."-".$row['HFIN'];
												$cpt++;
											}
										echo"			</tr>
													</thead>
												<tbody>
												<tr>";
										
										//création d'une variable test
											$test=null;
										//création d'une variable i
											$i=0;
										
										//insertion des jours de la semaine dans des variables afin de les ranger dans l'ordre
											$sql="SELECT NOMJ 
												  from JOUR
												  order by NOMJ asc;";
											foreach($connexion->query($sql) as $row){
												if($i==0){
													$JOUR7=$row['NOMJ'];
													$i++;
												}else if($i==1){
													$JOUR4=$row['NOMJ'];
													$i++;
												}else if($i==2){
													$JOUR1=$row['NOMJ'];
													$i++;
												}else if($i==3){
													$JOUR2=$row['NOMJ'];
													$i++;
												}else if($i==4){
													$JOUR3=$row['NOMJ'];
													$i++;
												}else if($i==5){
													$JOUR6=$row['NOMJ'];
													$i++;
												}else if($i==6){
													$JOUR5=$row['NOMJ'];
													$i++;
												}
												
											}
										
										//création d'une variable cpttest qui servira à construire le tableau
											$cpttest=0;
											
										//pour chaque jours
											//création d'un script permettant de résupérer les cours de la classe de l'élève durant ce jour
												$sql="SELECT * 
													  from cours
													  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR1."\"
													  order by NOMJ asc, HDEBUT asc;";
											
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											//on reset cpttest
												$cpttest=0;
												

											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR2."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR3."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR4."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR5."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR6."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
											$sql="SELECT * 
												  from cours
												  where NOMC = \"".$Classe."\" and NOMJ = \"".$JOUR7."\"
												  order by NOMJ asc, HDEBUT asc;";
											//pour chaque résultat
												foreach($connexion->query($sql) as $row){
													//si c'est le premier résultat
														if ($test==null || $row['NOMJ']!=$test){
															//on affiche le jour
																echo "</tr><tr><td>".$row['NOMJ']."</td>";
															//on set test et i
																$test=$row['NOMJ'];
																$i=0;
															
															//temps que le premier horaire ne correspond au head on rempli le tableau de vide
																while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																}
															
															//une fois que le premier horaire correspond au head on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
															//on incrémente cpttest et i
															$i=$i+1;
															 $cpttest=$cpttest+$i;
													}else{
															while($row['HDEBUT']."-".$row['HFIN']!=$Tab[$i]){
																	echo "<td> </td>";
																	$i++;
																	$cpttest++;
															}
														//si ce n'est pas le premier passe on rempli le tableau
															echo "<td>".$row['NOMM']." ".$row['NOMT']." ".$row['NOMS']." ".$row['MAILE']."</td>";
														//on incrémente cpttest et i
															$i=$i+1;
															$cpttest++;
													}
														
												}
												if ($cpttest!=$cpt && $cpttest>0){
													while ($cpttest!=$cpt){
														echo "<td> </td>";
														$cpttest++;
													}
												}
											$cpttest=0;
										
										//fin de la construction du tableau
											echo "		</tr>
													</tbody>
											</table><br>";
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
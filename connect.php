<!--fichier utilisé pour la connexion à la base de données-->
<?php

	//nom du serveur
		define('SERVEUR',"localhost");

	//nom de la base de données
		define('BASE',"emploi_du_temp");

	//nom de l'utisateur
		define('USER',"root");

	//mot de passe
		define('PASSWD',"");

	//fonction permettant la connexion
		function ConnecServ(){
			
			//mise en place du script de connexion
				$dsn="mysql:dbname=".BASE.";host=".SERVEUR;
			
			//tentative de connexion à la base de données
				try{
					$connexion=new PDO($dsn,USER,PASSWD);
				}
			
			//affichage d'éventuelles erreurs
				catch(PDOExecption $e){
					printf("Echec de la connexion : %s\n", $e->getMessage());
					exit();
				}
			
			//renvoi de la connexion
				return $connexion;
		}
		
?>
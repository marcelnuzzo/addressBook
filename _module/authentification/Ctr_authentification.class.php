<?php

class Ctr_authentification extends Ctr_controleur {
	public function __construct($action) {
        parent::__construct("authentification", $action,"modele_authentification.php");        
        $a = "a_$action";
        $this->$a();
	}

	function a_recupcode() {
		if(isset($_POST["verif_submit"], $_POST["verif_code"])) {
			if(!empty($_POST["verif_code"])) {
				$verif_code = htmlentities($_POST["verif_code"]);
				if(Recuperation::requestToVerifyCode($verif_code)){
					Recuperation::deleteRecup($verif_code);
					header("location:" . hlien("authentification","initmdp"));
				} else {
					$error = "Code invalide";
				}	
			} else {
				$error = "Veuillez entrer votre code de confirmation";
			}
		}
		require $this->gabarit;	
	}
	
	function a_recupmdp() {
		if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
			if(!empty($_POST['recup_mail'])) {
				$recup_mail = htmlspecialchars($_POST['recup_mail']);
				if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
					if ($row = User::verification($recup_mail) ) {
						$_SESSION["user_username"] = $row["user_firstname"]." ".$row["user_lastname"];
						$_SESSION["user_id"] = $row["user_id"];
						$_SESSION["recup_mail"] = $recup_mail;
						$username = $_SESSION["user_username"];
						$recup_code = "";
						for ($i=0; $i <8 ; $i++) { 
							$recup_code .= mt_rand(0, 9);
						}
						$_SESSION["recup_code"] = $recup_code;
						if(Recuperation::requestToRecoveryMail($recup_mail)) {
							echo "mail existe ".$recup_code."<br>";
							Recuperation::requestToUpdateCode($recup_mail,$recup_code);
						} else {
							echo "mail inexistant".$recup_code."<br>";
							Recuperation::requestToInsertCodeAndMail($recup_mail, $recup_code);
						}
						mailHtml($username, $recup_code, $recup_mail);
						header("location:" . hlien("authentification","recupcode","para",1));
					} else {
						$error = "Cette adresse mail n'est pas enregistrée";
					}
				} else {
					$error = "Adresse mail invalide";
				}
			}
			else {
				$error = "Veuillez entrer votre adresse mail";
			}
		}	
		require $this->gabarit;
	}

	function a_initmdp()
	{
		if(isset($_POST["change_mdp"])) {
			if(isset($_POST["change_mdp"], $_POST["change_mdpc"])) {
				$mdp = htmlspecialchars($_POST["change_mdp"]);
				$mdpc = htmlspecialchars($_POST["change_mdpc"]);
				if(!empty($_POST["change_mdp"] and $_POST["change_mdpc"])) {
					if($mdp == $mdpc) {
						$mdp=password_hash($mdp, PASSWORD_DEFAULT);
						$id = $_SESSION["user_id"];
						echo $id." ".$mdp;	
						Recuperation::requestToUpdateMdp($id, $mdp);
						session_destroy();
						header("location:" . hlien("authentification","index"));
					} else {
						$error = "Vos mots de passes ne correspondent pas";
					}
				} else {
					$error = "Veuillez remplir les champs";
				}
			} else {
				$error = "Veuillez remplir les champs";
			}
		}
		require $this->gabarit;	
	}
	
	function a_index() {
		if (isset($_POST["btSubmit"])) {
			extract($_POST);
			if ( $row=User::verification($user_email) ) {
				if (password_verify($_POST['user_password'],  $row["user_password"])) {
					$_SESSION["user_id"]=$row["user_id"];
					$_SESSION["user_email"]=$row["user_email"];
					$_SESSION["user_role"]=$row["user_role"];
					header("location:" . hlien("accueil","index"));
				} 
				else
					header("location:" . hlien("authentification","index","para",1));
			} 
			else
				header("location:" . hlien("authentification","index","para",1));		
		}
		else 
			require $this->gabarit;		
	}
	
	function a_deconnexion()
	{
		unset($_SESSION["user_id"]);
		session_destroy();
		header("location:" . hlien("authentification","index"));
	}
	
}

?>
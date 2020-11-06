<?php

class Ctr_user extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("user", $action);
        $this->table="user";
        $this->classTable = "User";
        $this->cle = "user_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=User::selectAll("user");
		$role="user_role";
		$resultprofil=User::requestToGroupByRoleUser();
		require $this->gabarit;
	}
	
	function a_show() {
		extract($_GET);
		$orderby = $idsortcriteria . " " . $idorder;
		if ($idprofiluser!="user_role")
			$idprofiluser= "'" . $idprofiluser . "'";
		$result=User::requestToShowUsers($idprofiluser,$orderby);
		$tab=$result->fetchAll(PDO::FETCH_ASSOC);
		$x=array();
		for ($i=0;$i<count($tab);$i++) {
			$x[$i]["user_id"]["label"]="N° référence";
			$x[$i]["user_id"]["value"]=$tab[$i]["user_id"];
			$x[$i]["user_firstname"]["label"]="Prénom";
			$x[$i]["user_firstname"]["value"]=$tab[$i]["user_firstname"];
			$x[$i]["user_lastname"]["label"]="Nom";
			$x[$i]["user_lastname"]["value"]=$tab[$i]["user_lastname"];
			$x[$i]["user_username"]["label"]="Nom d'utilisateur";
			$x[$i]["user_username"]["value"]=$tab[$i]["user_username"];
			$x[$i]["user_email"]["label"]="Adresse email";
			$x[$i]["user_email"]["value"]=$tab[$i]["user_email"];
			$x[$i]["user_role"]["label"]="Rôle";
			$x[$i]["user_role"]["value"]=$tab[$i]["user_role"];
			$x[$i]["user_createdat"]["label"]="Date de création";
			$x[$i]["user_createdat"]["value"]=$tab[$i]["user_createdat"];
			$x[$i]["href_count"]["label"]="Contacts";
			$count=Contact::requestToCountContactsForOneUser($tab[$i]["user_id"]);
			$y=$count->fetch(PDO::FETCH_ASSOC);
			$x[$i]["href_count"]["value"]='<a class="btn btn-warning" href="' . hlien("member", "showcontacts", "id", $tab[$i]["user_id"]) . '">Voir (nombre de contact : ' . $y['numberofcontacts'] . ')</a>';
			$x[$i]["href_edit"]["label"]="Modifier";
			$x[$i]["href_edit"]["value"]='<a class="btn btn-warning" href="' . hlien("user", "edit", "id", $tab[$i]["user_id"]) . '">Modifier</a>';
			$x[$i]["href_delete"]["label"]="Supprimer";
			$x[$i]["href_delete"]["value"]='<a class="btn btn-warning" href="' . hlien("user", "deleteOneUser", "id", $tab[$i]["user_id"]) . '">Supprimer</a>';
		}
		$json=json_encode($x, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		echo $json;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new User($id);
		extract($u->data);
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$_POST["user_password"]=password_hash($_POST["user_password"], PASSWORD_DEFAULT);
			$u=new User();
			$_POST["user_createdat"]=date("Y-m-d H:i:s");
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=user");
	}

	//param GET id 
	function a_deleteOneUser() {
		if (isset($_GET["id"])) {
			Contact::deleteContactsOfUser($_GET["id"]);
			User::delete("user","user_id",$_GET["id"]);
		}
		header("location:index.php?m=user");
	}
}

?>
<?php

class Ctr_member extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("member", $action);
        $this->table="user";
        $this->classTable = "User";
        $this->cle = "user_id";
        $a = "a_$action";
        $this->$a();
    }
	
	function a_showprofil() {
		$u=new User($_SESSION['user_id']);
		extract($u->data);
		$json=json_encode($u->data);
		require $this->gabarit;
	}
	
	function a_showcontacts() {
		$id = ($_SESSION["user_role"]=="user") ? $_SESSION["user_id"] : $_GET["id"];
		$result=Contact::requestToListContactsOfOneUser($id);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_editcontact() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		/*
		if ($_SESSION['user_role']=="user" && $id>0)
			$u=Contact::requestToShowOneContactOfOneUser($_SESSION['user_id'],$id);
		else
			*/
			$u=new Contact($id);
		
		extract($u->data);
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Contact();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=contact");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Contact::supprimer("contact","contact_id",$_GET["id"]);
		}
		header("location:index.php?m=contact");
	}
}
?>
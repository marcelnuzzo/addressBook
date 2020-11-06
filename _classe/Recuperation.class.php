<?php
class Recuperation extends Entity {
	public function __construct($id=0) {
		parent::__construct("recuperation", "recuperation_id",$id);
    }

    // vérification de l'existance du mail pour la récupération du code pour le mot de passe oublié
    static function requestToRecoveryMail($recup_mail) {
        $sql="select id from recuperation where mail = ?";
        $statement = self::$link->prepare($sql);
		$statement->bindValue(1,$recup_mail,PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount()==1)
			return $statement->fetch(PDO::FETCH_ASSOC);
		else
			return false;
    }

    // Vérification du code de vérif
    static function requestToVerifyCode($verif_code) {
        $sql="select * from recuperation where code = ?";
        $statement = self::$link->prepare($sql);
        $statement->bindValue(1,$verif_code,PDO::PARAM_INT);
		$statement->execute();
		if ($statement->rowCount()==1)
			return $statement->fetch(PDO::FETCH_ASSOC);
		else
			return false;
    }


    // Insertion du code généré et du mail si inexistant dans la table pour le mot de passe oublié
    static function requestToInsertCodeAndMail($recup_mail, $recup_code) {
        $sql="insert into recuperation values(null,:mail,:code)";
        $statement = self::$link->prepare($sql);
        $statement->bindValue(":mail",$recup_mail,PDO::PARAM_STR);
        $statement->bindValue(":code",$recup_code,PDO::PARAM_INT);
        $statement->execute();
        return self::$link->query($sql);
    }

    // Mise à jour du nouveau code pour le mail existant dans la table pour le mot de passe oublié
    static function requestToUpdateCode($recup_mail,$recup_code)  {
        $sql="update recuperation set code=:code where mail =:mail";
        $statement = self::$link->prepare($sql);
        $statement->bindValue(":mail",$recup_mail,PDO::PARAM_STR);
        $statement->bindValue(":code",$recup_code,PDO::PARAM_INT);
        $statement->execute();
        return self::$link->query($sql);
    } 

    // Mise à jour du nouveau mot de passe 
    static function requestToUpdateMdp($id, $mdp)  {
        $sql="update user set user_password=:mdp where user_id=$id";
        $statement = self::$link->prepare($sql);
        $statement->bindValue(":mdp",$mdp,PDO::PARAM_STR);
        $statement->execute();
        return self::$link->query($sql);
    } 

    //supprimer l'enregistrement de la récupération du mot de passe
	static function deleteRecup($verif_code) {
		$sql="delete from recuperation where code=$verif_code";
		return self::$link->query($sql);
    }
    
}
<?php
class User extends Entity {
	public function __construct($id=0) {
		parent::__construct("user", "user_id",$id);
	}
	
//request to list of roles among of users
	static function requestToGroupByRoleUser() {
		$sql="select user_role from user group by user_role";
		return self::$link->query($sql);
	}
	
	//show users
	static function requestToShowUsers($profil,$orderby) {
		$sql="select * from user where user_role=$profil order by $orderby";
		return self::$link->query($sql);
	}
	
	static function verification($user_email) {
		$sql="select * from user where user_email=?";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(1,$user_email,PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount()==1)
			return $statement->fetch(PDO::FETCH_ASSOC);
		else
			return false;
	}

}
?>
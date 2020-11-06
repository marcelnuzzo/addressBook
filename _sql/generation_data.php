<?php

require "config.php";


$faker = Faker\Factory::create('fr_FR');

//Insertion of users
$nbusers = 10;
$sql = "insert into user values (null,:user_lastname,:user_firstname,:user_email,:user_username,:user_password,:user_role,:user_createdat)";
$statement = $link->prepare($sql);
for ($i = 1; $i <= $nbusers; $i++) {
	$lastname = $faker->lastname;
	$firstname = $faker->firstname;
	$email = $firstname . "." . $lastname . "@" . $faker->freeEmailDomain;
	$statement->bindValue(":user_lastname", $lastname, PDO::PARAM_STR);
	$statement->bindValue(":user_firstname", $firstname, PDO::PARAM_STR);
	$statement->bindValue(":user_email", $email, PDO::PARAM_STR);
	$statement->bindValue(":user_username", $faker->username, PDO::PARAM_STR);
	$statement->bindValue(":user_password", $faker->password, PDO::PARAM_STR);
	$statement->bindValue(":user_role", "admin", PDO::PARAM_STR);
	$statement->bindValue(":user_createdat", date("Y-m-d"), PDO::PARAM_STR);
	$statement->execute();
}

//Insertion of contacts
$sql = "insert into contact values (null,:contact_lastname,:contact_firstname,:contact_photo,:contact_description,:contact_birth,:contact_postaladdress,:contact_postalcode,:contact_city,:contact_email,:contact_telephone,:contact_mobile,:contact_createdat,:contact_user)";
$statement = $link->prepare($sql);
for ($i = 1; $i <= $nbusers; $i++) {
	for ($j = 1; $j <= 5; $j++) {
		$lastname = $faker->lastname;
		$firstname = $faker->firstname;
		$email = $firstname . "." . $lastname . "@" . $faker->freeEmailDomain;
		$statement->bindValue(":contact_lastname", $lastname, PDO::PARAM_STR);
		$statement->bindValue(":contact_firstname", $firstname, PDO::PARAM_STR);
		$statement->bindValue(":contact_photo", "kevin", PDO::PARAM_STR);
		$statement->bindValue(":contact_description", $faker->text, PDO::PARAM_STR);
		$statement->bindValue(":contact_birth", date("Y-m-d H:i:s"), PDO::PARAM_STR);
		$statement->bindValue(":contact_postaladdress", $faker->streetAddress, PDO::PARAM_STR);
		$statement->bindValue(":contact_postalcode", $faker->postcode, PDO::PARAM_INT);
		$statement->bindValue(":contact_city", $faker->city, PDO::PARAM_STR);
		$statement->bindValue(":contact_email", $email, PDO::PARAM_STR);
		$statement->bindValue(":contact_telephone", $faker->e164PhoneNumber, PDO::PARAM_STR);
		$statement->bindValue(":contact_mobile", $faker->e164PhoneNumber, PDO::PARAM_STR);
		$statement->bindValue(":contact_createdat", date("Y-m-d H:i:s"), PDO::PARAM_STR);
		$statement->bindValue(":contact_user", $i, PDO::PARAM_INT);
		$statement->execute();
	}
}

echo "bonjour";
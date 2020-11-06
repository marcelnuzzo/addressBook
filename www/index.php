<?php
require "../_include/inc_config.php";

$controleur=(isset($_GET["m"]) ) ? $_GET["m"] : "_default";
$action=(isset($_GET["a"]) ) ? $_GET["a"] : "index";
$module = "Ctr_" . $controleur;
new $module($action);
/*
require "../_include/inc_config.php";
$_CTR_MEMBER=["accueil","member"];

//paremetre $_GET m=module et a=action
if (isset($_SESSION["user_id"])) {
	$controleur=(isset($_GET["m"]) ) ? $_GET["m"] : "authentification";
	$action=(isset($_GET["a"]) ) ? $_GET["a"] : "index";
	if (!in_array($controleur,$_CTR_MEMBER) and $_SESSION["user_role"]=="user")
		header("location:" . hlien("accueil","index"));
} else {
	$controleur="authentification";
	$action="index";
}

$module = "Ctr_" . $controleur;
new $module($action);
*/
?>
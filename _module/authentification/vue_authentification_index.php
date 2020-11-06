<h1>Espace d’authentification</h1>
<?php
if (isset($_GET["para"]))
	echo "<div class='alert alert-primary' role='alert'>Erreur d'authentification</div>";
?>
<form method="post" action="<?php echo hlien("authentification","index")?>">			
	<div class="form-group row">
		<div class="col-md-2">
			<label for="user_email">Adresse email : </label>
		</div>
		<div class="col-md-6">
			<input type="text" id="user_email" name="user_email">
		</div>
	</div>						
	<div class="form-group row">
		<div class="col-md-2">
			<label for="user_password">Mot de passe : </label>
		</div>
		<div class="col-md-6">
			<input type="password" id="user_password" name="user_password">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-2"></div>
		<div class="col-md-6">
			<a href='<?=hlien("authentification","recupmdp") ?>'>Mot de passe oublié !</a>&nbsp;
		</div>
	</div>
	<div class="form-group row">
		<input class="btn btn-success" type="submit" value="Se connecter" name="btSubmit" >&nbsp;
	</div>
</form>
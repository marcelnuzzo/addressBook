<form method="post" action="<?=hlien("member","save")?>">
	<input type="hidden" name="contact_id" id="contact_id" value="<?= $id ?>" />
	<h1><?=$contact_id ? "Modification du contact" : "Création d’un nouveau contact"?></h1>
	<fieldset>
		<legend>
			<h2>Informations personnelles</h2>
		</legend>
		<label for='contact_lastname'>Nom :</label>
		<input id='contact_lastname' name='contact_lastname' type='text' size='50' value='<?=mhe($contact_lastname)?>'  class='form-control' />
		<label for='contact_firstname'>Prénom :</label>
		<input id='contact_firstname' name='contact_firstname' type='text' size='50' value='<?=mhe($contact_firstname)?>'  class='form-control' />
		<label for='contact_birth'>Date de naissance :</label>
		<input id='contact_birth' name='contact_birth' type='date' value='<?=mhe($contact_birth)?>'  class='form-control' />
		<label for='contact_photo'>Importer une photo</label>
		<input id='contact_photo' name='contact_photo' type='file' />
		<label for='contact_description'>Quelques mots sur le contact :</label>
		<textarea id='contact_description' name='contact_description'><?=mhe($contact_description)?></textarea>
	</fieldset>
	<fieldset>
		<legend>
			<h2>Coordonnées</h2>
		</legend>
		<label for='contact_postaladdress'>Adresse postale :</label>
		<input id='contact_postaladdress' name='contact_postaladdress' type='text' size='50' value='<?=mhe($contact_postaladdress)?>'  class='form-control' />
		<label for='contact_postalcode'>Code postal :</label>
		<input id='contact_postalcode' name='contact_postalcode' type='text' size='50' value='<?=mhe($contact_postalcode)?>'  class='form-control' />
		<label for='contact_city'>Ville :</label>
		<input id='contact_city' name='contact_city' type='text' size='50' value='<?=mhe($contact_city)?>'  class='form-control' />
		<label for='contact_email'>Adresse email :</label>
		<input id='contact_email' name='contact_email' type='email' size='50' value='<?=mhe($contact_email)?>'  class='form-control' />
		<label for='contact_telephone'>N° téléphone fixe :</label>
		<input id='contact_telephone' name='contact_telephone' type='tel' size='50' value='<?=mhe($contact_telephone)?>'  class='form-control' />
		<label for='contact_mobile'>N° mobile :</label>
		<input id='contact_mobile' name='contact_mobile' type='tel' size='50' value='<?=mhe($contact_mobile)?>'  class='form-control' />
	</fieldset>
	<fieldset>
	<select id='contact_user' name='contact_user' >
				<?=Entity::HTMLselect("select user_id id, user_username label from user",$contact_user)?>
				</select>
</form>
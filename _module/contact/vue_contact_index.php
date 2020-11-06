<h1>Gestion des contacts</h1>
<a href='<?=hlien("contact","recupmdp") ?>'>Mot de passe oublié !</a>&nbsp;
<p><a class="btn btn-warning" href="<?= hlien("member", "editcontact", "id", 0) ?>">Créer un nouveau contact</a></p>
<?php if ($result!=null) { ?>
<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Personne</th>
		<th>Résumé</th>
		<th>Utilisateur</th>
		<th>Voir</th>
		<th>Modifier</th>
		<th>Supprimer</th>
	</tr>
	<?php
	foreach ($result as $row) {
		extract($row); ?>
		<tr>
			<td>
				<?= mhe($row['contact_lastname']) ?> <?= mhe($row['contact_firstname']) ?>
				<?= mhe($row['contact_photo']) ?>
			</td>
			<td><?= mhe($row['contact_description']) ?></td>
			<td><?= mhe($row['user_firstname']) ?> <?= mhe($row['user_lastname']) ?></td>
			<td><a class="btn btn-info" href="<?= hlien("contact", "show", "id", $row["contact_id"]) ?>">Voir</a></td>
			<td><a class="btn btn-info" href="<?= hlien("member", "editcontact", "id", $row["contact_id"]) ?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?= hlien("member", "del", "id", $row["contact_id"]) ?>">Supprimer</a></td>
		</tr>
	<?php } ?>
</table>
<?php } else { ?>
<p>Aucun contact enregistré.</p>
<?php } ?>
<h1>Mon profil – <?=$user_lastname?> <?=$user_firstname?></h1>
<button id="idBtnShow">Afficher les informations en mode tableau</button>
<div id="divlist" style="display:inline">
	<h2>Informations personnelles</h2>
	<ul>
		<li>Prénom : <?=$user_firstname?></li>
		<li>Nom : <?=$user_lastname?></li>
		<li>Adresse email : <?=$user_email?></li>
	</ul>
	<h2>Informations sur le compte</h2>
	<ul>
		<li>Nom d'utilisateur : <?=$user_username?></li>
		<li>
			<a href="">Changer le mot de passe</a>
		</li>
		<li>Profil : <?=$user_role?></li>
		<li>Créé le <?=$user_createdat?></li>
	</ul>
</div>
<div id="divarray" style="display:none">
	<table>
		<caption>
			<h2>Informations personnelles</h2>
		</caption>
		<tbody>
			<tr>
				<th>Prénom</th>
				<td><?=$user_firstname?></td>
			</tr>
			<tr>
				<th>Nom</th>
				<td><?=$user_lastname?></td>
			</tr>
			<tr>
				<th>Adresse email</th>
				<td><?=$user_email?></td>
			</tr>
		</tbody>
	</table>
	<table>
		<caption>
			<h2><h2>Informations sur le compte utilisateur</h2>
		</caption>
		<tbody>
			<tr>
				<th>Nom d'utilisateur</th>
				<td><?=$user_username?></td>
			</tr>
			<tr>
				<th>Mot de passe</th>
				<td>
					<a href="">Changer le mot de passe</a>
				</td>
			</tr>
			<tr>
				<th>Date de création</th>
				<td><?=$user_createdat?></td>
			</tr>
		</tbody>
	</table>
</div>
<script>

function show() {
	let list = document.getElementById("divlist");
	let array = document.getElementById("divarray");
	if (list.style.display=="inline") {
		array.style.display="inline";
		list.style.display="none";
		idBtnShow.innerHTML="Afficher les informations en mode liste";
	} else {
		array.style.display="none";
		list.style.display="inline";
		idBtnShow.innerHTML="Afficher les informations en mode tableau";
	}
}

idBtnShow.addEventListener("click",()=>show());

</script>
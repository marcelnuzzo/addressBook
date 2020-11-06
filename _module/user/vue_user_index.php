<div id="resultat"></div>
<h1>Gestion des comptes utilisateurs</h1>
<p><a class="btn btn-warning" href="<?= hlien("user", "edit", "id", 0) ?>">Créer un nouveau compte utilisateur</a></p>
<div>
	<select aria-label="Trier par" id="idsortcriteria" onchange="show()">
		<option value="user_id">N° référence</option>
		<option value="user_firstname">Prénom</option>
		<option value="user_lastname">Nom</option>
		<option value="user_username">Nom d'utilisateur</option>
	</select>
	<select aria-label="Ordre" id="idorder" onchange="show()">
		<option value="asc">Croissant</option>
		<option value="desc">Décroissant</option>
	</select>
	<select aria-label="Filtrer par profil" id="idprofiluser" onchange="show()">
		<option value="user_role">Tous</option>
		<?php
		
		foreach($resultprofil as $profil)
			echo '<option value="' . $profil['user_role'] . '">' . $profil['user_role'] . '</option>';
			?>
	</select>
</div>
<button id="idBtnShow">Afficher les informations en mode tableau</button>
<div id="divlist" style="display:inline"></div>
<div id="divtable" style="display:none"></div>
<script>

//fonction pour initialiser l'appel ajax
function getXmlhttp() {
	if (window.XMLHttpRequest)
		return new XMLHttpRequest();
	else if (window.ActiveXObject)
		return new ActiveXObject("Msxml2.XMLHTTP");
	else
		throw new Error("Could not create HTTP request object.");
}

function show() {
	var xmlhttp;
	var para= "idsortcriteria=" + idsortcriteria.value + "&idorder=" + idorder.value + "&idprofiluser=" + idprofiluser.value;
	console.log(para);
	xmlhttp= getXmlhttp();
	xmlhttp.open("GET","http://localhost/addressBook/www/index.php?m=user&a=show&" + para,true);
	xmlhttp.onreadystatechange=mafonction;
	xmlhttp.send();
	
	function mafonction() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			let result = xmlhttp.responseText;
			result = JSON.parse(result);
			show_list(result);
			show_table(result);
		}
	}
}

show();

function show_table(array) {
	divtable.innerHTML="";
	let table = document.createElement("table");
	let tr = document.createElement("tr");
	for (let field in array[0]) {
		tr.innerHTML+="<th scope='col'>" + array[0][field]["label"] + "</th>";
	}
	table.appendChild(tr);
	//divtable.appendChild(table);
	tbody = document.createElement("tbody");
	for (let i = 0; i < array.length; i++) {
		tr = document.createElement("tr");
		for (field in array[i]) {
			if (idsortcriteria.value==field)
				tr.innerHTML+="<th scope='row'>" + array[i][field]["value"] + "</th>";
			else
				tr.innerHTML += "<td>" + array[i][field]["value"] + "</td>";
		}
		tbody.appendChild(tr);
	}
	table.appendChild(tbody);
	divtable.appendChild(table);
}

function show_list(array) {
	divlist.innerHTML="";
	for (let i=0;i<array.length;i++) {
		divlist.innerHTML+="<h1>" + array[i][idsortcriteria.value]["label"] + " : " + array[i][idsortcriteria.value]["value"] + "</h1><ul>";
		for (let field in array[i]) {
			if (field.includes("href_")==false)
				divlist.innerHTML+="<li>" + array[i][field]["label"] + " : " + array[i][field]["value"] + "</li>";
			else
				divlist.innerHTML+="<li>" + array[i][field]["value"] + "</li>";
		}
	}
	divlist.innerHTML+="</ul>";
}

function show_object() {
	let list = document.getElementById("divlist");
	let table = document.getElementById("divtable");
	if (list.style.display=="inline") {
		table.style.display="inline";
		list.style.display="none";
		idBtnShow.innerHTML="Afficher les informations en mode liste";
	} else {
		table.style.display="none";
		list.style.display="inline";
		idBtnShow.innerHTML="Afficher les informations en mode tableau";
	}
}

idBtnShow.addEventListener("click",()=>show_object());

</script>
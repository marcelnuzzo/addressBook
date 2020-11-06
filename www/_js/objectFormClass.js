class ObjectFormClass {
	constructor(idparent, type_object, id_object, name_object, text_label, aria, array) {
		this.idparent = document.getElementById(idparent);
		this.type_object=type_object;
		this.id_object=id_object;
		this.name_object=name_object;
		this.text_label=text_label;
		this.aria=aria;
		this.array=array;
		this.createObjectForm();
	}
	
	createObjectForm() {
		this.object_form = document.createElement(this.type_object);
		this.object_form.id=this.id_object;
		this.object_form.name=this.name_object;
		
		for (let i=0;i<this.array.length;i++)
			this.object_form.innerHTML+=`<option value="${this.array[i]["value"]}">${this.array[i]["label"]}</option>`;
		
		this.idparent.appendChild(this.object_form);
	}
}
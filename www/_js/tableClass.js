class TableClass {
    constructor(array, idparent, object_show) {
        this.array = array;
        this.idparent = idparent;
		this.object_show = object_show;
		this.idparent = document.getElementById(idparent);
		this.idparent.innerHTML = "";
		if (this.object_show=="table")
			this.show_table();
	}
	
	show_table() {
		this.table = document.createElement("table");
		this.tr = document.createElement("tr");
		for (this.value in this.array[0]) {
			this.th = document.createElement("th");
			this.th.innerHTML=this.value;
			this.tr.appendChild(this.th);
		}
		this.table.appendChild(this.tr);
		this.tbody = document.createElement("tbody");
		for (let i = 0; i < this.array.length; i++) {
			this.tr = document.createElement("tr");
			for (this.value in this.array[i]) {
				this.td = document.createElement("td");
				this.td.innerHTML = this.array[i][this.value];
				this.tr.appendChild(this.td);
			}
			this.tbody.appendChild(this.tr);
		}
		this.table.appendChild(this.tbody);
		this.idparent.appendChild(this.table);
	}
}
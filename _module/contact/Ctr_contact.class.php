<?php

class Ctr_contact extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("contact", $action);
        $this->table="contact";
        $this->classTable = "Contact";
        $this->cle = "con_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Contact::requestToListContacts();
		$groupByUser=Contact::requestToGroupByUserContacts();
		$groupByPostalCode=Contact::requestToGroupByPostalCodeContacts();
		$groupByCity=Contact::requestToGroupByCityContacts();
		require $this->gabarit;
    }
    
    function a_recupmdp() {
        require $this->gabarit;
    }
}

?>
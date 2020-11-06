<?php

class Ctr_recuperation extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("recuperation", $action);
        $this->table="recuperation";
        $this->classTable = "Recuperation";
        $this->cle = "rec_id";
        $a = "a_$action";
        $this->$a();
    }
/*
    function a_recupcode() {
        $result=Recuperation::requestToRecoveryCode($recup_mail);
        require $this->gabarit;
    }
    */
}
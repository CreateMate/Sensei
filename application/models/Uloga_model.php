<?php

class Uloga_model extends CI_Model{
    public $id_uloga;
    public $uloga;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function dodajUlogu()
    {
        $this->db->insert("uloga",array('id_uloga'=>$this->id_uloga, 'uloga'=>$this->uloga));
    }
}

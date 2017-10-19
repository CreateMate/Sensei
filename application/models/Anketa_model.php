<?php

class Anketa_model extends CI_Model{
    
    public $id_anketa;
    public $tekst;
    public $vote;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function izaberiAnketu()
    {
        $query="SELECT * FROM anketa";
        $rez= $this->db->query($query);
        $br=$rez->num_rows();
        $id_anketa=  rand(1, $br);
       
        $query="SELECT * FROM anketa WHERE id_anketa=".$id_anketa;
        $rezultat=  $this->db->query($query);
        
        return $rezultat->row();
    }
    public function sveAnkete()
    {
        return $this->db->query("SELECT * FROM anketa")->result();
    }
    public function izbrisiAnketu()
    {
        $this->db->delete("anketa",array('id_anketa'=>$this->id_anketa));
    }
    public function upisiAnketu()
    {
        $this->db->insert('anketa',array('tekst'=>  $this->tekst));
    }
    public function vratiAnketu()
    {
        return $this->db->get_where("anketa"," id_anketa=".$this->id_anketa);
    }
    public function izmeniAnketu()
    {
        $podaci=array(
           
            'tekst'=>  $this->tekst
        );
        $this->db->where('id_anketa',  $this->id_anketa);
        $this->db->update('anketa',$podaci);
    }
}

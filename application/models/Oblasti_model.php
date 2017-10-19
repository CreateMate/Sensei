<?php

class Oblasti_model extends CI_Model{
    public $id_oblast;
    public $oblast;
    public $slika;
    public $description;
    public $username;
    public $id_korisnik;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function sveOblasti()
    {
       return $this->db->get("oblast")->result();
    }
    public function korisnikoveOblasti()
    {
        $query=$this->db->query("SELECT * FROM oblast INNER JOIN korisnik_oblast ON oblast.id_oblast = korisnik_oblast.id_oblast WHERE id_korisnik=".$this->id_korisnik);

        return $query->result();//$podaci;
    }
    public function korisnikOblastEditAccount()
    {
        $query=$this->db->query("SELECT * FROM oblast LEFT JOIN korisnik_oblast ON oblast.id_oblast = korisnik_oblast.id_oblast ");
        return $query->result();
    }
    public function korisnikOblast()
    {
        $query=  $this->db->query(" SELECT id_korisnik FROM korisnik WHERE username='".$this->username."'"); //ovde moguca greska
        $rez=$query->row();
        $podaci= array('id_korisnik'=>  $rez->id_korisnik, 'id_oblast'=>  $this->id_oblast);
        $this->db->insert('korisnik_oblast',$podaci);
//        $posledji_id=  $this->db->insert_id();
    }
    public function unfollow()
    {
        $this->db->delete("korisnik_oblast",array('id_korisnik'=>  $this->id_korisnik, 'id_oblast'=>  $this->id_oblast));
    }
    public function follow()
    {
       $podaci= array('id_korisnik'=>  $this->id_korisnik, 'id_oblast'=>  $this->id_oblast);
        $this->db->insert('korisnik_oblast',$podaci);
    }
    public function izbrisiOblast()
    {
        $this->db->delete("oblast",array('id_oblast'=>  $this->id_oblast));
    }
    public function upisiOblast()
    {
        $this->db->insert('oblast',array('oblast'=>  $this->oblast,'slika_oblast'=>  $this->slika));
    }
    public function vratiOblast()
    {
        return $this->db->query("SELECT * FROM oblast WHERE id_oblast=".$this->id_oblast)->row();
    }
    public function OblastKorisnik()
    {
        return $this->db->query("SELECT * FROM oblast INNER JOIN korisnik_oblast ON oblast.id_oblast "
                . "= korisnik_oblast.id_oblast INNER JOIN korisnik on korisnik.id_korisnik=korisnik_oblast.id_korisnik");       
    }
    
}

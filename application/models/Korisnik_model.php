<?php

class Korisnik_model extends CI_Model{
    
    public $id_korisnik;
    public $id_uloga;
    public $username;
    public $datum_registracije;
    public $password;
    public $status;
    public $email;
    public $code;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function proveri()
    {
        $query = $this->db->query("SELECT id_korisnik,username,email,password,uloga FROM korisnik INNER JOIN uloga ON korisnik.id_uloga=uloga.id_uloga"
                . " WHERE username='".$this->username."' AND password='".md5($this->password). "' AND status=1");
        $row=$query->row();
       
        return $row;
    }
    public function registracijaKorisnika()
    {
        $podaci=array(
            'username'=>  $this->username,
            'password'=> md5($this->password),
            'email'=>  $this->email,
            'datum_registracije'=>date("Y-m-d H:i:s"),
            'status'=>0,
            'code'=>$this->code,
            'id_uloga'=>3
        );
        if($this->db->insert('korisnik',$podaci))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public function promeniStatus()
    {
        $uslov= array('username'=>  $this->username, 'code'=>  $this->code);
        $this->db->where($uslov);
        $status=array('status'=>1);
        if($this->db->update('korisnik',$status))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function vratiKorisnika()
    {
        $query=$this->db->query('SELECT id_korisnik FROM korisnik WHERE username="'.$this->username.'" AND code='.$this->code);
        return $query->row();
    }
    public function vratiSveOKorisniku()
    {
        $query=$this->db->query('SELECT * FROM korisnik WHERE username="'.$this->username.'" AND code='.$this->code);
        return $query->row();
    }
    public function vratiSveOKorisnikuUsername()
    {
        $query=$this->db->query('SELECT * FROM korisnik WHERE username="'.$this->username.'"');
        return $query->row();
    }
    public function editKorisnika()
    {
        $podaci=array(
            'username'=>  $this->username,
            'password'=> md5($this->password),
            'email'=>  $this->email,
            'datum_registracije'=>$this->datum_registracije,
            'status'=>1,
            'code'=>$this->code,
            'id_uloga'=>3
        );
        //$this->db->where('id_korisnik',  $this->id_korisnik);
        
        if($this->db->update('korisnik',$podaci))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    function email()
    {
        return $this->db->get_where("korisnik","email='".$this->email."'")->row();
    }
    public function sviKorisnici()
    {
        $query=$this->db->query('SELECT * FROM korisnik inner join uloga ON korisnik.id_uloga=uloga.id_uloga');
        return $query->result();
    }
    public function izbrisiKorisnika()
    {
        $this->db->delete("korisnik",array('id_korisnik'=>  $this->id_korisnik));
    }
    public function unosKorisnika()
    {
        $podaci=array(
            'username'=>  $this->username,
            'password'=> md5($this->password),
            'email'=>  $this->email,
            'datum_registracije'=>date("Y-m-d H:i:s"),
            'status'=>1,
            'code'=>$this->code,
            'id_uloga'=>  $this->id_uloga
        );
        $this->db->insert('korisnik',$podaci);
    }
    public function vratiKorisnikaUpdate()
    {
        $query=$this->db->query('SELECT * FROM korisnik JOIN uloga on korisnik.id_uloga = uloga.id_uloga WHERE id_korisnik='.$this->id_korisnik);
        return $query->row();
    }
    public function izmeniKorisnika()
    {
         $podaci=array(
            'username'=>  $this->username,
             'password'=>  md5($this->password),
             'email'=>  $this->email,
             'status'=>  $this->status,
             'datum_registracije'=>date("Y-m-d H:i:s"),
             'code' => $this->code,
             'id_uloga'=>  $this->id_uloga
            
        );
        $this->db->where('id_korisnik',  $this->id_korisnik);
        $this->db->update('korisnik',$podaci);
    }
    public function izmeniKorisnikaEdit()
    {
         $podaci=array(
            'username'=>  $this->username,
             'password'=>  md5($this->password),
             'email'=>  $this->email,
             'status'=>  $this->status,
             'datum_registracije'=>date("Y-m-d H:i:s"),
             'code' => $this->code,
             'id_uloga'=>  $this->id_uloga
            
        );
        $this->db->where('id_korisnik',  $this->id_korisnik);
        $this->db->update('korisnik',$podaci);
    }
}

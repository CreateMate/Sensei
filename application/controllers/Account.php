<?php

class Account extends MY_Controller{
    
     private $potreban=false;
     
    public function __construct() {
        parent::__construct();
        
        $this->podaci['meta']=array(
               array('name'=>'robots', 'content'=>'no-cache'),
               array('name'=>'description', 'content'=>'Sensei | Web Application with amazing facts. Find out some really interesting facts about the world, history, celebrities, and many more." '),
               array('name'=>'keywords','content'=>'sensei, interesting facts, history, brainy facts', 'lang'=>'en', 'xml:lang'=>'en'),
               array('name'=>'Content-type', 'content'=>'text/html; charset=utf-8', 'type'=>'equiv'),
               array('name'=>'author','content'=>'United.Brains@ict.edu.rs')
           ); 
        $this->podaci['title']="Sensei | Edit Your Account Settings";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/account_settings.css');
        $this->podaci['links'][]= link_tag('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css','stylesheet prefetch');
    }
    public function index()
    {
            $this->load->view('header',  $this->podaci);
            $this->load->helper('form');
            $this->load->library('form_validation','session');
            $this->load->database();
            
            if(!$this->session->userdata('ulogovan'))
            {
                //if($this->session->flashdata("potvrdio")) //ovde napraviti proveriti flash_data koji se pravi u potvrdi email --- $potvrdio==true
             //{
                    
                    $this->load->model('Korisnik_model','korisnik');
                    $this->korisnik->username="milos123";//$this->session->flashdata("username");
                    $korisnik=$this->korisnik->vratiSveOKorisnikuUsername();
                    $this->podaci['id_korisnika_registracija']=$korisnik->id_korisnik;
                    
                    $this->load->model('Oblasti_model','oblast');
                    $this->podaci['sve_oblasti']=$this->oblast->sveOblasti();
              //}
            }
            else
            {
                $this->load->model('Oblasti_model','oblast');
                $this->podaci['sve_oblasti']=$this->oblast->sveOblasti();

                $this->oblast->id_korisnik = $this->session->userdata('id_korisnik');
                $this->podaci['korisnikove_oblasti']=  $this->oblast->korisnikoveOblasti();
            }

            if(!$this->potreban)
            {
                $this->load->view('account_settings',$this->podaci);
            }
    }
    public function Registration()
    {
        
    }
    public function follow($id_oblast, $id_kor=NULL)
    {
        $this->load->model('Oblasti_model');
        if($id_kor==null)
        {
            $this->Oblasti_model->id_korisnik=  $this->session->userdata('id_korisnik');
        }
        else
        {
            $this->Oblasti_model->id_korisnik=$id_kor;
        }
        
        $this->Oblasti_model->id_oblast=$id_oblast;
        $this->Oblasti_model->follow();
    }
    public function unfollow($id_oblast, $id_kor=NULL)
    {
        $this->load->model('Oblasti_model');
        if($id_kor==null)
        {
            $this->Oblasti_model->id_korisnik=  $this->session->userdata('id_korisnik');
        }
        else
        {
            $this->Oblasti_model->id_korisnik=$id_kor;
        }
        $this->Oblasti_model->id_oblast=$id_oblast;
        $this->Oblasti_model->unfollow();
    }
    //put your code here
}

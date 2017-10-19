<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{
    private $podaci;
    
     public function __construct() {
        parent::__construct();
        
        $this->podaci['meta']=array(
            array('name'=>'robots', 'content'=>'no-cache'),
            array('name'=>'description', 'content'=>'Strana registracija'),
            array('name'=>'keywords', 'content'=>'test'),
            array('name'=>'Content-type', 'content'=>'text/html; charset=utf-8', 'type'=>'equiv')
        );
        $this->podaci['title']="Sensei | Admin panel";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/admin.css');
        $this->load->database();
        $this->load->library('grocery_CRUD');
       
    }
    public function index()
    {
        $this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
       
    }
    public function korisnik()
    {
        try{
             $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('korisnik');
            
            $crud->columns('id_korisnik','username','email','datun_registracije','status','code','sd6d003a2');
            
            $crud->set_relation('id_uloga','uloga','uloga');
            $crud->display_as('sd6d003a2', 'Uloga');
            
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
        
    }
    public function post()
    {
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('post');          
            $crud->columns('naslov','slika_post','kratak_opis','vreme_postavljanja','broj_lajkova','sb8b8b939');
            
            $crud->set_field_upload('slika_post','../Sajt/');
            $crud->required_fields('naslov','slika_post','tekst','id_oblast','broj_lajkova','vreme_postavljanja');
            $crud->set_relation('id_oblast', 'oblast', 'oblast');
             
              $crud->display_as('naslov','Naslov')
				 ->display_as('slika_post','Slika')
				 ->display_as('kratak_opis','Opis posta')
                    ->display_as('sb8b8b939','Oblast');
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    public function oblast()
    {
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('oblast');
            $crud->set_subject('Oblast');           
           
            $crud->columns('id_oblast','oblast','slika_oblast');
            $crud->display_as('slika_oblast','Slika');            
            $crud->set_field_upload('slika_oblast','../Sajt/');
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    public function uloge()
    {
         try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('uloga');
            $crud->set_subject('Uloga');           
           
            $crud->columns('id_uloga','uloga');
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
     public function anketa()
    {
         try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('anketa');
            $crud->set_subject('Anketa');           
           
            $crud->columns('id_anketa','tekst');
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    public function korisnik_oblast()
    {
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('oblast');
            $crud->set_relation_n_n('Korisnik', 'korisnik_oblast', 'korisnik', 'id_oblast', 'id_korisnik', 'id_korisnik');
            //$crud->set_re
            
            // $crud->columns('naslov','slika_oblast','kratak_opis','vreme_postavljanja','broj_lajkova','sb8b8b939');
              $crud->display_as('naslov','Naslov')
				 ->display_as('slika_post','Slika')
				 ->display_as('kratak_opis','Opis posta')
                    ->display_as('sb8b8b939','Oblast');
              $crud->set_field_upload('slika_oblast','../Sajt/');
              $crud->unset_edit();
              $crud->unset_add();
              $crud->unset_read();
            $output = $crud->render();
            $this->_example_output($output);

        }
        catch(Exception $e)
        {
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    public function _example_output($output = null)
    {
        $this->load->view('example.php',$output);
    }
    
    /*private function ucitajOblastiKorisnika()
    {
        $this->load->model('Oblasti_model');
        $this->Oblasti_model->id_korisnik= $this->session->userdata("id_korisnik");
        $oblasti=$this->Oblasti_model->korisnikoveOblasti();

        return $oblasti;
    }
    public function izbrisiKorisnika($id)
    {
        $this->load->model("Korisnik_model","korisnik");
        $this->korisnik->id_korisnik=$id;
        $this->korisnik->izbrisiKorisnika();
        redirect("Admin");
    }
    public function upisiKorisnika()
    {
        $username=$this->input->post("tbUsername");
        $password=$this->input->post("tbPassword");
        $email=$this->input->post("tbEmail");
        $id_uloga=$this->input->post("ddlUloga");
        
        $this->load->model("Korisnik_model","korisnik");
        $this->korisnik->username=$username;
        $this->korisnik->password=$password;
        $this->korisnik->email=$email;
        $x=rand(0,20000);
        $this->korisnik->code=$x;
        $this->korisnik->id_uloga=$id_uloga;
        $this->korisnik->unosKorisnika();
        redirect("admin");
    }
    public function izmeniKorisnika($id)
    {
         if($this->session->userdata('uloga')=='admin')
        {
            $this->load->view("header",$this->podaci);
            $this->load->view("fiksiran",$this->podaci);
            
            $this->load->model('Korisnik_model','korisnik');
            $this->korisnik->id_korisnik=$id;
            $korisnik=$this->korisnik->vratiKorisnikaUpdate();
           
            $this->podaci['post']=false;
            $this->podaci['anketa']=false;
            $this->podaci['korisnik']=true;
            
            $this->podaci['username']=$korisnik->username;
            $this->podaci['password']=$korisnik->password;
            $this->podaci['email']=$korisnik->email;
            $this->podaci['status']=$korisnik->status;
            $this->podaci['id_uloga']=$korisnik->id_uloga;
            $this->podaci['uloga']=$korisnik->uloga;
            
            $this->podaci['idKorisnik']=$id;
            $this->load->view('izmena',  $this->podaci);
            
            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;
            $this->load->view("jumping",$this->podaci);
        }
    
    }
    public function izmeniKorisnikaSubmit()
    {
        $username=$this->input->post("tbUsername");
        $password=$this->input->post("tbPassword");
        $email=$this->input->post("tbEmail");
        $status=$this->input->post("tbStatus");
        $id_uloga=$this->input->post("ddlUloga");
        
        $this->load->model("Korisnik_model","korisnik");
        $this->korisnik->id_korisnik=$this->input->post("idKorisnik");
        $this->korisnik->username=$username;
        $this->korisnik->password=$password;
        $this->korisnik->email=$email;
        $this->korisnik->status=$status;
        $this->korisnik->code=rand(0,20000);
        $this->korisnik->id_uloga=$id_uloga;
        $this->korisnik->izmeniKorisnika();
    }
    public function sveOblasti()
    {
        $this->load->model("Oblasti_model","oblasti");
        return $this->oblasti->sveOblasti();
    }
    public function izbrisiOblast($id)
    {
        $this->load->model("Oblasti_model","oblasti");
        $this->oblasti->id_oblast=$id;
        $oblast=$this->oblasti->vratiOblast();
        unlink("".$oblast->slika_oblast);
        $this->oblasti->id_oblast=$id;
        $this->oblasti->izbrisiOblast();
        redirect("admin");
    }
    public function upisiOblast()
    {
        $file_name = $_FILES['fileOblastSlika']['name'];
        $file_size =$_FILES['fileOblastSlika']['size'];
        $file_tmp =$_FILES['fileOblastSlika']['tmp_name'];
        $file_type=$_FILES['fileOblastSlika']['type'];
        move_uploaded_file($file_tmp,"images/oblasti/".$file_name);
        $oblast=$this->input->post("tbOblast");
        
        $this->load->model("Oblasti_model","oblasti");
        $this->oblasti->oblast=$oblast;
        $this->oblasti->slika="images/oblasti/".$file_name;
        $this->oblasti->upisiOblast();
        
        redirect("admin");
    }
    public function sviPostovi()
    {
        $this->load->model("Post_model");
        return $this->Post_model->sviPostoviAdmin();
    }
    public function izbrisiPost($id)
    {
        $this->load->model("Post_model");
        $this->Post_model->id_post=$id;
        $post=$this->Post_model->vratiPost();
        unlink("".$post->slika_post);
        $this->Post_model->izbrisiPost();
        redirect("admin");
    }
    public function upisiPost()
    {
        $file_name = $_FILES['filePostSlika']['name'];
        $file_size =$_FILES['filePostSlika']['size'];
        $file_tmp =$_FILES['filePostSlika']['tmp_name'];
        $file_type=$_FILES['filePostSlika']['type'];
      
        move_uploaded_file($file_tmp,"images/post/".$file_name);
        $naslov=$this->input->post("tbNaslov");
        $tekst=$this->input->post("tbTekst");
        $id_oblast=$this->input->post("ddlOblast");
        
        $this->load->model("Post_model");
        $this->Post_model->naslov=$naslov;
        $this->Post_model->tekst=$tekst;
        $this->Post_model->slika="images/post/".$file_name;
        $this->Post_model->id_oblastt=$id_oblast;
        $this->Post_model->upisiPost();
        redirect("admin");
    }
     public function izmeniPost($id)
    {
        if($this->session->userdata('uloga')=='admin')
        {
            $this->load->view("header",$this->podaci);
            $this->load->view("fiksiran",$this->podaci);
            
            $this->load->model('Post_model');
            $this->Post_model->id_post=$id;
            $post=$this->Post_model->vratiPost();
            $form_tag_atributi=array(
                'name'=>'formIzmenaAnketa',
                'id'=>'formIzmenaAnketa'
            );
            $this->podaci['post']=true;$this->podaci['anketa']=false;$this->podaci['korisnik']=false;
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            
            $naslov_tag=array('name'=>'tbNaslov', 'id'=>'tbNaslov');
            $this->podaci['naslov_tag']=$naslov_tag;
            
            $tekst_tag_atributi=array('name'=>'tbTekst', 'id'=>'tbTekst');
            $this->podaci['tekst_tag_atributi']=$tekst_tag_atributi;
            
            $broj_lajkova_tag_atributi=array('name'=>'tbLajkovi', 'id'=>'tbLajkovi');
            $this->podaci['broj_lajkova_tag_atributi']=$broj_lajkova_tag_atributi;
            
            $slika_tag=array('name'=>'fileSlika', 'id'=>'fileSlika');
            $this->podaci['slika_tag']=$slika_tag;
            
          
            $podaci_oblast=  $this->sveOblasti();
            $this->podaci['oblastiSve']=$podaci_oblast;
            
            $this->podaci['idPost']=$id;
            $this->load->view('izmena',  $this->podaci);
            
            
            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;
            $this->load->view("jumping",$this->podaci);
        }
    }
    public function izmeniPostSubmit()
    {
        
        $file_name = $_FILES['fileSlika']['name'];
        $file_size =$_FILES['fileSlika']['size'];
        $file_tmp =$_FILES['fileSlika']['tmp_name'];
        $file_type=$_FILES['fileSlika']['type'];
      
        move_uploaded_file($file_tmp,"images/post/".$file_name);
        
        $naslov=$this->input->post("tbNaslov");
        $br=$this->input->post("tbLajkovi");
        $tekst=$this->input->post("tbTekst");
        $id_oblast=$this->input->post("ddlOblasti");
        $id=$this->input->post("idPost");
        
        $this->load->model("Post_model");
        $this->Post_model->id_post=$id;
        $this->Post_model->naslov=$naslov;
        $this->Post_model->tekst=$tekst;
        $this->Post_model->broj_lajkova=$br;
        $this->Post_model->slika="images/post/".$file_name;
        $this->Post_model->id_oblastt=$id_oblast;
        $this->Post_model->izmeniPost();
        redirect("admin");
    }
    public function sveAnkete()
    {
        $this->load->model("Anketa_model","anketa");
        return $this->anketa->sveAnkete();
    }
     public function izbrisiAnketu($id)
    {
        $this->load->model("Anketa_model","anketa");
        $this->anketa->id_anketa=$id;
        $this->anketa->izbrisiAnketu();
        redirect("admin");
    }
    public function upisiAnketu()
    {
        $this->load->model('Anketa_model','anketa');
        $anketa=$this->input->post("tbAnketa");
        $this->anketa->tekst=$anketa;
        $this->anketa->upisiAnketu();
        redirect("admin");
    }
    public function izmeniAnketu($id)
    {
        if($this->session->userdata('uloga')=='admin')
        {
            $this->load->view("header",$this->podaci);
            $this->load->view("fiksiran",$this->podaci);
            
            $this->load->model('Anketa_model','anketa');
            $this->anketa->id_anketa=$id;
            $anketa=$this->anketa->vratiAnketu();
            $form_tag_atributi=array(
                'name'=>'formIzmenaAnketa',
                'id'=>'formIzmenaAnketa'
            );
            $this->podaci['anketa']=true;$this->podaci['post']=false;$this->podaci['korisnik']=false;
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            $tekst_tag_atributi=array('name'=>'tbTekst', 'id'=>'tbTekst');
            $this->podaci['tekst_tag_atributi']=$tekst_tag_atributi;
            $this->podaci['idAnketa']=$id;
            $this->load->view('izmena',  $this->podaci);
            
            
            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;
            $this->load->view("jumping",$this->podaci);
        }
    }
    public function izmeniAtributSubmit()
    {
        $tekst=$this->input->post("tbTekst");
        $id=$this->input->post("idAnketa");
        $this->load->model('Anketa_model','anketa');
        $this->anketa->tekst=$tekst;
        $this->anketa->id_anketa=$id;
        $this->anketa->izmeniAnketu();
        redirect("admin");
    }*/
}

<?php

class Edit extends CI_Controller{
    
     private $podaci =array();
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
        $this->podaci['title']="Sensei | Edit Your Account";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/registracija_style.css');
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
                redirect("NIje ulogovan");
            }
            $dugme=  $this->input->post("btnRegistracija");

            $form_tag_atributi=array('id'=>'formaRegistracija', 'name'=>'formaRegistracija');//NAPRAVITI OVU METODU EDIT ACCOUNT
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            
            $username_atributi=array('id'=>'tbUsername', 'name'=>'tbUsername', 'value'=>$this->session->userdata('username'),'class'=>'form-control');
            $this->podaci['username_atributi']=$username_atributi;
            
            $password_atributi=array('id'=>'tbPassword', 'name'=>'tbPassword', 'class'=>'form-control', 'placeholder'=>'Password');
            $this->podaci['password_atributi']=$password_atributi;
            
            $confirm_password_atributi=array('id'=>'tbConfirmPassword', 'name'=>'tbConfirmPassword', 'class'=>'form-control', 'placeholder'=>'Confirm Password');
            $this->podaci['confirm_password_atributi']=$confirm_password_atributi;
            
            $email_atributi=array('id'=>'tbEmail', 'name'=>'tbEmail', 'value'=>$this->session->userdata('email'), 'class'=>'form-control');
            $this->podaci['email_atributi']=$email_atributi; 
        
            if(isset($dugme))
            {
                $this->form_validation->set_message('required','The %s field is required');
                $this->form_validation->set_message('min_length','The %s field must have more than 5 characters');
                $this->form_validation->set_message('matches','Passwords must match');
                $this->form_validation->set_message('is_unique','The %s field must be unique');
                $this->form_validation->set_message('valid_email','Please enter valid email address');
                $this->form_validation->set_message('xss_clean','Cross site scripting');
                
                $pravila=array(
                    array('field'=>'tbUsername', 'label'=>'Username', 'rules'=>'trim|required|min_length[5]'),//DODATI is_unique kad resis problem
                    array('field'=>'tbPassword','label'=>'Password', 'rules'=>'trim|required|min_length[5]|matches[tbConfirmPassword]'),
                    array('field'=>'tbConfirmPassword', 'label'=>'Confirm password','rules'=>'trim|required'),
                    array('field'=>'tbEmail', 'label'=>'Email', 'rules'=>'trim|required|valid_email')//DODATI IS UNIQUE KAD RESIS PROBLEM ILI AKO NE POSTOJI RESENJE PRAVI CALLBACK
                );
                $this->form_validation->set_rules($pravila);
                
                if($this->form_validation->run() ==  TRUE)
                {
                    $username=$this->session->userdata('username');
                    
                    $this->load->model('Korisnik_model','korisnik');
                    $this->korisnik->username=$username;
                    $korisnikoviPodaci=$this->korisnik->vratiSveOKorisnikuUsername();
                    
                    $usernameInserted=  trim($this->input->post("tbUsername"));
                    $passwordInserted= trim($this->input->post("tbPassword"));
                    $emailInserted = trim($this->input->post("tbEmail"));
                    
                    $this->korisnik->id_korisnik=$korisnikoviPodaci->id_korisnik;
                    $this->korisnik->username=$usernameInserted;
                    $this->korisnik->password=$passwordInserted;
                    $this->korisnik->email=$emailInserted; 
                    $this->korisnik->code=$korisnikoviPodaci->code;
                    $this->korisnik->datum_registracije=$korisnikoviPodaci->datum_registracije;
                    
                    if($this->korisnik->editKorisnika())
                    {
                       
                        $newdata = array(
                                        'id_korisnik' => $korisnikoviPodaci->id_korisnik,
                                        'username'  => $usernameInserted,
                                        'uloga' => 3,
                                        'email'     => $emailInserted,
                                        'ulogovan' => TRUE
                                );

                        $this->session->set_userdata($newdata);
                        redirect("Sadrzaj");
                    }
                    else
                    {
                        echo("Problem u modelu");
                        //Ako postoji greska sa bazom, nema drugog nacina da se dodje ovde
                        $this->podaci['greska_baza']="Sorry, we have a problem with your registration, please try again later.";
                    }
                }
            }
            if(!$this->potreban)
            {
                $this->load->view('edit',$this->podaci);
            }
    }
    public function Account()
    {
            $this->load->view('header',  $this->podaci);
            $this->load->helper('form');
            $this->load->library('form_validation','session');
            $this->load->database();
            
            if(!$this->session->userdata('ulogovan'))
            {
                redirect("NIje ulogovan");
            }
            $dugme=  $this->input->post("btnRegistracija");

            $form_tag_atributi=array('id'=>'formaRegistracija', 'name'=>'formaRegistracija');//NAPRAVITI OVU METODU EDIT ACCOUNT
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            
            //$username_atributi=array('id'=>'tbUsername', 'name'=>'tbUsername', 'value'=>$this->session->userdata('username'),'class'=>'form-control');
            //$this->podaci['username_atributi']=$username_atributi;
            
            $this->load->model('Oblasti_model','oblast');
            $this->podaci['sve_oblasti']=$this->oblast->sveOblasti();
            
            $this->oblast->id_korisnik = $this->session->userdata('id_korisnik');
            $this->podaci['korisnikove_oblasti']=  $this->oblast->korisnikoveOblasti();
        
            if(isset($dugme))
            {
                if($this->form_validation->run() ==  TRUE)
                {
                   /* $username=$this->session->userdata('username');
                    
                    $this->load->model('Korisnik_model','korisnik');
                    $this->korisnik->username=$username;
                    $korisnikoviPodaci=$this->korisnik->vratiSveOKorisnikuUsername();
                    
                    $usernameInserted=  trim($this->input->post("tbUsername"));
                    $passwordInserted= trim($this->input->post("tbPassword"));
                    $emailInserted = trim($this->input->post("tbEmail"));
                    
                    $this->korisnik->id_korisnik=$korisnikoviPodaci->id_korisnik;
                    $this->korisnik->username=$usernameInserted;
                    $this->korisnik->password=$passwordInserted;
                    $this->korisnik->email=$emailInserted; 
                    $this->korisnik->code=$korisnikoviPodaci->code;
                    $this->korisnik->datum_registracije=$korisnikoviPodaci->datum_registracije;
                    
                    if($this->korisnik->editKorisnika())
                    {
                       
                        $newdata = array(
                                        'id_korisnik' => $korisnikoviPodaci->id_korisnik,
                                        'username'  => $usernameInserted,
                                        'uloga' => 3,
                                        'email'     => $emailInserted,
                                        'ulogovan' => TRUE
                                );

                        $this->session->set_userdata($newdata);
                        redirect("Sadrzaj");
                    }
                    else
                    {
                        echo("Problem u modelu");
                        //Ako postoji greska sa bazom, nema drugog nacina da se dodje ovde
                        $this->podaci['greska_baza']="Sorry, we have a problem with your registration, please try again later.";
                    }*/
                    
                    
                }
            }
            if(!$this->potreban)
            {
                $this->load->view('account_settings',$this->podaci);
            }
    }
    //put your code here
}

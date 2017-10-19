<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registracija extends CI_Controller{
  
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
        
        $this->podaci['title']="Sensei | Make Your Account";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/style.css');
        $this->podaci['links'][]= link_tag('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css','stylesheet prefetch');
    }
     public function index()
    {
            $this->load->view('header',  $this->podaci);
            $this->load->helper('form');
            $this->load->library('form_validation','session');
            $this->load->database();
            
            if($this->session->userdata('ulogovan'))
            {
                redirect("Sadrzaj");
            }
            $dugme=  $this->input->post("btnRegistracija");

            $form_tag_atributi=array('id'=>'formaRegistracija', 'name'=>'formaRegistracija', 'onSubmit'=>'registracijaProvera();');
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            
            $username_atributi=array('id'=>'tbUsername', 'name'=>'tbUsername', 'class'=>'form-control', 'placeholder'=>'Username');
            $this->podaci['username_atributi']=$username_atributi;
            
            $password_atributi=array('id'=>'tbPassword', 'name'=>'tbPassword', 'class'=>'form-control', 'placeholder'=>'Password');
            $this->podaci['password_atributi']=$password_atributi;
            
            $confirm_password_atributi=array('id'=>'tbConfirmPassword', 'name'=>'tbConfirmPassword', 'class'=>'form-control', 'placeholder'=>'Confirm Password');
            $this->podaci['confirm_password_atributi']=$confirm_password_atributi;
            
            $email_atributi=array('id'=>'tbEmail', 'name'=>'tbEmail', 'class'=>'form-control', 'placeholder'=>'Email');
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
                    array('field'=>'tbUsername', 'label'=>'Username', 'rules'=>'trim|required|min_length[5]|is_unique[korisnik.username]'),//DODATI is_unique kad resis problem
                    array('field'=>'tbPassword','label'=>'Password', 'rules'=>'trim|required|min_length[5]|matches[tbConfirmPassword]'),
                    array('field'=>'tbConfirmPassword', 'label'=>'Confirm password','rules'=>'trim|required'),
                    array('field'=>'tbEmail', 'label'=>'Email', 'rules'=>'trim|required|valid_email|is_unique[korisnik.email]')//DODATI IS UNIQUE KAD RESIS PROBLEM ILI AKO NE POSTOJI RESENJE PRAVI CALLBACK
                );
                $this->form_validation->set_rules($pravila);
                
                if($this->form_validation->run() ==  TRUE)
                {
                    $username=$this->input->post('tbUsername');
                    $password=  $this->input->post('tbPassword');
                    $email=  $this->input->post('tbEmail');
                    
                    $this->load->model('Korisnik_model','korisnik');
                    $this->korisnik->username=$username;
                    $this->korisnik->password=$password;
                    $this->korisnik->email=$email;
                    $x=  rand(0, 20000);
                    $this->korisnik->code=$x;
                    
                    if($this->korisnik->registracijaKorisnika())
                    {
                        $this->korisnik->username=$username;
                        $this->korisnik->code=$x;                
                        /*
                         $message = "Click on link ".base_url()."registracija/potvrdiEmail/".$username."/".$x." so u can confirm your registration on Sensei. This is a generic email,"
                          . "so please do not answer. ";
                                $this->load->library('email');
                              $this->email->set_newline("\r\n");
                              $this->email->from('sensei@gmail.com', 'Your Sensei');
                              $this->email->to($email);
                              $this->email->subject('Sensei account registration');
                              $this->email->message($message);
                              if($this->email->send())
                              {*/
                                $this->potreban=true;
                                $this->potvrditiAccount($email, $username, $x);
                              /*}
                              else
                              {
                                show_error($this->email->print_debugger());
                              }
                         
                         */
                    }
                    else
                    {
                        //Ako postoji greska sa bazom, nema drugog nacina_ da se dodje ovde
                        $this->podaci['greska_baza']="Sorry, we have a problem with your registration, please try again later.";
                    }
                }
            }
            if(!$this->potreban)
            {
                $this->load->view('registracija',$this->podaci);
            }
    }
    public function potvrditiAccount($email, $username, $x)
    {
        $this->podaci['email']=$email;
        $this->podaci['username']=$username;
        $this->podaci['code']=$x;
        $this->load->view('header',  $this->podaci);
        $this->load->view('potvrditiAccount', $this->podaci);
    }
    public function potvrdiEmail($username, $code)
    {
        $this->load->model('Korisnik_model','korisnik');
        $this->korisnik->username=$username;
        $this->korisnik->code=$code;
        if($this->korisnik->promeniStatus())
        {
            $this->session->set_flashdata(array('potvrdio'=>true, 'username'=>$username));
            redirect('Account');
        }
        else
        {
            $this->session->set_flashdata('greska','Takav korisnik ne postoji.. Zlonamerni korisnice sram te bilo');
        }
    }
    public function resend()
    {
        $username=  $this->input->post("username");
        $email=$this->input->post("email");
        $x=$this->input->post("code");
       $message = "Click on link ".base_url()."registracija/potvrdiEmail/".$username."/".$x."' so u can confirm your registration on Sensei. This is a generic email,"
        . "so please do not answer. ";
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('sensei@gmail.com', 'Your Sensei');
            $this->email->to($email);
            $this->email->subject('Sensei account registration');
            $this->email->message($message);
            
            if($this->email->send())
            {
              $this->potreban=true;
              $this->potvrditiAccount($email, $username, $x);
            }
            else
            {
              show_error($this->email->print_debugger());
            }
                   // $this->potvrditiAccount($email, $username, $x);
   
    }
}
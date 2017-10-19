<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logovanje extends MY_Controller{
    
    public function __construct() {
        
        parent::__construct();
        
        $this->podaci['meta']=array(
               array('name'=>'robots', 'content'=>'no-cache'),
               array('name'=>'description', 'content'=>'Sensei | Web Application with amazing facts. Find out some really interesting facts about the world, history, celebrities, and many more." '),
               array('name'=>'keywords','content'=>'sensei, interesting facts, history, brainy facts', 'lang'=>'en', 'xml:lang'=>'en'),
               array('name'=>'Content-type', 'content'=>'text/html; charset=utf-8', 'type'=>'equiv'),
               array('name'=>'author','content'=>'United.Brains@ict.edu.rs')
           ); 

           $this->podaci['linkovi']=array(
               anchor('logovanje/logout', 'Logout')
               );
               $this->podaci['title']='Welcome to Sensei | Web application with amazing facts'; 
               $this->podaci['base_url']=  base_url();
               $this->podaci['links'][]=  link_tag('css/style.css');
               $this->podaci['links'][]= link_tag('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css','stylesheet prefetch');
            
               
            $this->load->library('form_validation');
            $this->load->helper('form');
        
    }
    public function index()
    {
            
            $this->load->view('header',  $this->podaci);
            
            $form_tag_atributi=array('id'=>'formaRegistracija', 'name'=>'formaRegistracija','onSubmit'=>'return provera();');
            $this->podaci['form_tag_atributi']=$form_tag_atributi;
            
            $username_atributi=array('id'=>'tbUsername', 'name'=>'tbUsername', 'class'=>'form-control', 'placeholder'=>'Username');
            $this->podaci['username_atributi']=$username_atributi;
            
            $password_atributi=array('id'=>'tbPassword', 'name'=>'tbPassword', 'class'=>'form-control', 'placeholder'=>'Password');
            $this->podaci['password_atributi']=$password_atributi;
            
            $this->load->view('logovanje',$this->podaci);
    }
    public function login()
    {
        $dugme=$this->input->post("btnLogin");
        $username=  trim($this->input->post("tbUsername"));
        $password= trim($this->input->post("tbPassword"));
        
        if($dugme && $username!="" && $password!="")
        {
            $this->load->model('Korisnik_model','korisnik');
            $this->korisnik->username=$username;
            $this->korisnik->password=$password;
            $korisnik=$this->korisnik->proveri();
            
            if(count($korisnik)>0)
            {
							
                $uloga=$korisnik->uloga;
                $id_korisnik= $korisnik->id_korisnik;
                $usernameKorisnika=$korisnik->username;
                $email=$korisnik->email;
                
                switch($uloga)
                {
                    case "admin":
                        $newdata = array(
                                        'id_korisnik' => $id_korisnik,
                                        'username'  => $usernameKorisnika,
                                        'uloga' => $uloga,
                                        'email'     => $email,
                                        'ulogovan' => TRUE
                                );

                        $this->session->set_userdata($newdata);
                        redirect("Sadrzaj");
                        exit();
                        break;
                    case "moderator":
                         $newdata = array(
                                        'id_korisnik' => $id_korisnik,
                                        'username'  => $usernameKorisnika,
                                        'uloga' => $uloga,
                                        'email'     => $email,
                                        'ulogovan' => TRUE
                                );

                        $this->session->set_userdata($newdata);
                        redirect("MODERATOR");
                        exit();
                        break;
                     case "korisnik":
                         $newdata = array(
                                        'id_korisnik' => $id_korisnik,
                                        'username'  => $usernameKorisnika,
                                        'uloga' => $uloga,
                                        'email'     => $email,
                                        'ulogovan' => TRUE
                                );

                        $this->session->set_userdata($newdata);
                        redirect("Sadrzaj");
                        exit();
                        break;
                }
            }
            else
            {
                redirect("Logovanje");
            }
        }
    }
    public function lostPassword()
    {
         $this->load->view('header', $this->podaci);
         $this->form_validation->set_message('valid_email','Please enter valid email address');
         $this->form_validation->set_message('required','Please enter a valid email address');
         $this->form_validation->set_message('email_check','That email address does not exist in our database.');
           
         $username_atributi=array('id'=>'tbEmail', 'name'=>'tbEmail', 'class'=>'form-control', 'placeholder'=>'example@email.com');
         
         $this->podaci['username_atributi']=$username_atributi;
         $form_tag_atributi=array('id'=>'formaRegistracija', 'name'=>'formaRegistracija','onSubmit'=>'return provera();');
         $this->podaci['form_tag_atributi']=$form_tag_atributi;
          
         $rules=array(
             array('name'=>'tbEmail', 'label'=>'Email', 'rules'=>'trim|required|valid_email')
         );
         
         $this->form_validation->set_rules($rules);
         
         if($this->form_validation->run())
         {
            $email=$this->input->post('tbEmail');
            $this->load->model('Korisnik_model','korisnik');
            $this->korisnik->email=$email;
            $korisnik=$this->korisnik->email();
            
            $link="Sensei".rand(0, 20000);
            
            $this->korisnik->id_korisnik=$korisnik->id_korisnik;
            $this->korisnik->username=$korisnik->username;
            $this->korisnik->password=$link;
            $this->korisnik->email=$email;
            $this->korisnik->status=$korisnik->status;
            $this->korisnik->code=$korisnik->code;
            $this->korisnik->id_uloga=$korisnik->id_uloga;
            
            $username=$korisnik->username;
            $this->korisnik->izmeniKorisnika();
            
            $this->load->library('email');

            $this->email->from('sensei@gmail.com', 'Your Sensei');
            $this->email->to($email);
            $this->email->cc('sensei@gmail.com');
            $this->email->bcc('sensei@gmail.com');

            $this->email->subject('New Password');
            $this->email->message('This is your username - '.$username.' and your new password - '.$link.'. Try to save it this time haha :). '.base_url().'/Logovanje. Your Sensei!');

            $this->email->send();
            $this->load->view("lost_password_sent",  $this->podaci);
         }
        else 
        {
            $this->load->view("lost_password",  $this->podaci);
        }
            
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("Logovanje");
    }
}

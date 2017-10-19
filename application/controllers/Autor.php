<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autor extends CI_Controller{
    private $podaci;
    public function __construct() 
    {
        parent::__construct();
         $meta=array(
            array('name'=>'robots', 'content'=>'no-cache'),
            array('name'=>'description', 'content'=>'Strana Oblsti'),
            array('name'=>'keywords', 'content'=>'test'),
            array('name'=>'Content-type', 'content'=>'text/html; charset=utf-8', 'type'=>'equiv')
        );
        $this->podaci['meta']=$meta;
        $this->podaci['title']="Sensei | Author";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/autor.css');
    }
    public function index(){
        
        $this->load->helper(array('form', 'url', 'html'));
        if($this->session->userdata('ulogovan'))
        {
            $this->podaci['username']=$this->session->userdata('id_korisnika');
            $this->load->view("header",  $this->podaci);
            $this->load->view("fiksiran",$this->podaci);

            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;

            $this->load->view("autor_sadrzaj",  $this->podaci);
            $this->load->view("jumping",$this->podaci);
            $this->podaci['anketa_podaci']=  $this->anketa();
            $this->load->view("footer",  $this->podaci);
        }
        else
        {
            redirect("logovanje");
        }
    }
    private function ucitajOblastiKorisnika()
    {
        $this->load->model('Oblasti_model');
        $this->Oblasti_model->id_korisnik= $this->session->userdata("id_korisnik");
        $oblasti=$this->Oblasti_model->korisnikoveOblasti();

        return $oblasti;
    }
    public function anketaAjax()
    {
        $this->load->model("Anketa_model");
        $rez=$this->Anketa_model->izaberiAnketu();
        
        echo '<div id="footer-part-anketa">';
        echo"<div class='footer-part-anketa-gornji'>";
            echo "<p class='footer-description'>".$rez->tekst."</p>";
        echo '</div><br/>';
         echo "<div class='footer-part-anketa-donji'>
                  <a onclick='anketaAjax();return false;'><img src='".base_url()."images/next2.png'/></a>
               </div>
             </div>";
    }
    public function anketa()
    {
           $this->load->model("Anketa_model");
           $rez=$this->Anketa_model->izaberiAnketu();
           return $rez;
    }
}

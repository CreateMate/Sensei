<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sadrzaj extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->podaci['meta']=array(
               array('name'=>'robots', 'content'=>'no-cache'),
               array('name'=>'description', 'content'=>'Sensei | Web Application with amazing facts. Find out some really interesting facts about the world, history, celebrities, and many more." '),
               array('name'=>'keywords','content'=>'sensei, interesting facts, history, brainy facts', 'lang'=>'en', 'xml:lang'=>'en'),
               array('name'=>'Content-type', 'content'=>'text/html; charset=utf-8', 'type'=>'equiv'),
               array('name'=>'author','content'=>'United.Brains@ict.edu.rs')
           ); 
        
        $this->podaci['title']="Sensei | Web application with amazing facts";
        $this->podaci['base_url']=  base_url();
        $this->podaci['links'][]=link_tag('css/sadrzaj_style.css');
        $this->podaci['links'][]=link_tag('css/mobile.css');
        
    }
    
    public function index()
    {
       
        $this->load->library("pagination");
        $this->load->helper(array('form', 'url', 'html'));
        
        if($this->session->userdata('ulogovan'))
        {
            $this->podaci['username']=  $this->session->userdata('username');
            $this->load->view('header',  $this->podaci);
            $this->load->view('fiksiran',  $this->podaci);
            
            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;
            $this->load->model('Post_model');
            
            $this->Post_model->id_korisnik=$this->session->userdata('id_korisnik');
        
            $data['total_rows']= $this->Post_model->brojPostova(); 
            $data['base_url']="http://localhost/Sajt/Sadrzaj/index";
            $data['per_page']=6;
            $data['num_links']=5;
            $this->pagination->initialize($data);

            $this->Post_model->limit= $data['per_page'];
            if($this->uri->segment(3)!=null)
            {
                $this->Post_model->offset=$this->uri->segment(3);
            }
            else
            {
                $this->Post_model->offset=0;
            }
            $id=$this->session->userdata('id_korisnik');
            $this->Post_model->id_korisnik=$id;
            $lajkovani_postovi=  $this->Post_model->lajkovaniPostovi();
            $this->Post_model->id_korisnik=$id;
            $postovi=$this->Post_model->sviPostoviPrikazSaLajkom($sveOblasti);
            $this->podaci['postovi']=$postovi;
            $this->podaci['lajkovani_postovi']=$lajkovani_postovi;
            $this->podaci['username']=  $this->session->userdata('username');
            
            $this->load->view('sadrzaj_postovi',  $this->podaci);
            $this->load->view('jumping',  $this->podaci);
            $this->podaci['anketa_podaci']=  $this->anketa();
            $this->load->view('footer',  $this->podaci);
        }        
        else
        {
            redirect("http://localhost/Sajt/Logovanje");
        }
    }
    private function ucitajOblastiKorisnika()
    {
        $this->load->model('Oblasti_model');
        $this->Oblasti_model->id_korisnik= $this->session->userdata("id_korisnik");
        $oblasti=$this->Oblasti_model->korisnikoveOblasti();

        return $oblasti;
    }
    public function nadjiOblasti()
    {
         $id_post=  $this->input->post("id_post");
         $this->load->model('Post_model','post');
         $this->post->id_post=$id_post;
         $oblasti=  $this->post-> oblastiPosta();
         
         print json_encode($oblasti);
    }
    public function dodajLike($id)
    {   
        $this->load->model('Post_model');
        $this->Post_model->id_post=$id;
        $this->Post_model->id_korisnik= $this->session->userdata('id_korisnik');
        $this->Post_model->dodajLikeVise();
    }
     public function oduzmiLike($id)
    {   
        $this->load->model('Post_model');
        $this->Post_model->id_post=$id;
        $this->Post_model->oduzmiLike();
    }
    public function field($oblast)
    {
        $this->load->library("pagination");
        $this->load->helper(array('form', 'url', 'html'));
        
        if($this->session->userdata('ulogovan'))
        {
            $this->podaci['username']=  $this->session->userdata('username');
            $this->load->view('header',  $this->podaci);
            $this->load->view('fiksiran',  $this->podaci);
            $sveOblasti=$this->ucitajOblastiKorisnika();
            $this->podaci['oblasti']=$sveOblasti;
            $this->load->model('Post_model');
            $data['total_rows']= $this->db->get_where("post","id_oblast=".$oblast)->num_rows(); 
            $data['base_url']="http://sensei.pe.hu/index.php/Sadrzaj/field/".$oblast."/";
            $data['per_page']=6;
            $data['num_links']=5;
            $this->pagination->initialize($data);

            $this->Post_model->limit= $data['per_page'];
            $this->Post_model->offset=$this->uri->segment(4);
            $this->Post_model->id_oblastt=$oblast;

            $postovi=$this->Post_model->filterPost();
            
            $id=$this->session->userdata('id_korisnik');
            $this->Post_model->id_korisnik=$id;
            $lajkovani_postovi=  $this->Post_model->lajkovaniPostovi();
            $this->podaci['lajkovani_postovi']=$lajkovani_postovi;
            
            $hidden_tag_name=('idOblast');
            $hidden_tag_value=($oblast);

            $this->podaci['hidden_tag_name']=$hidden_tag_name;
            $this->podaci['hidden_tag_value']=$hidden_tag_value;
            $this->podaci['postovi']=$postovi;

            $this->load->view('sadrzaj_postovi',  $this->podaci);
            $this->load->view('jumping',  $this->podaci);
            $this->podaci['anketa_podaci']=  $this->anketa();
            $this->load->view('footer',  $this->podaci);
        }
        else
        {
            redirect("http://sensei.pe.hu/index.php/Logovanje");
        }
    }
    public function like()
    {
            $this->podaci['username']=  $this->session->userdata('username');
            $id=$this->input->get("id");
            $like=  $this->input->get("naslov");
            $this->load->model("Post_model");
           
            $this->Post_model->naslov=$like;
            $this->Post_model->id_korisnik=$this->session->userdata("id_korisnik");
            if(isset($id))
            {
                $this->Post_model->id_oblastt=$id;
            }
           
            $rez=$this->Post_model->filterLike();
            foreach($rez as $red)
            {
                echo "<div class='middle-funterest'>";
                echo "<img src='". base_url()."". $red->slika_post."' width='100%' height='230px' alt='".$red->naslov."' class='slika'/>";
                  echo "<div class='middle-lightup-inner'><h4 class='sensei'>".$red->naslov."</h4></div><hr>";
                   echo "<div class='middle-lightup-inner middle-lightup-text'><p class='sensei'>".$red->kratak_opis."</p></div>";
                    echo "<div class='middle-lightup-inner ispis' >";
                         echo "<div class='senseiLike-wrapper ".$red->id_post.">";
                         echo "<a href='#' onClick='ajaxLike(".$red->id_post.");return false' class='senseiLike levo' id='senseiLike' name='senseiLike'>";
                                echo "<img src='".base_url()."images/up.png' alt='sensei like'/>";
                            echo "</a>
                            </div>";
                            echo "<div class='broj_lajkova'><p class='sensei povecaj'>".$red->broj_lajkova."</p></div>";
                            
                           echo "<p class='sensei middle-lightup-text-bottom desno'><b>".$red->oblast."</b></p>";
                           echo "<p class='sensei middle-lightup-text-bottom desno'>".$red->vreme_postavljanja."</p>"
                                   . " <a href='' onclick='ajaxPrikazPostaKomentar(".$red->id_post."); return false' class='comment-text'>Comment...</a>";
                    echo " </div>
                                        
                </div>";
            }
    }
    public function popularni()
    {
        $this->podaci['username']=  $this->session->userdata('username');
        $this->load->library("pagination");
        $this->load->view('header',  $this->podaci);
        $this->load->view('fiksiran',  $this->podaci);
        $this->load->helper(array('form', 'url', 'html'));
        
        $sveOblasti=$this->ucitajOblastiKorisnika();
        $this->podaci['oblasti']=$sveOblasti;
        $this->load->model('Post_model');
        
        $this->Post_model->id_korisnik=$this->session->userdata('id_korisnik');
        $data['total_rows']= $this->db->get_where("post","broj_lajkova>5")->num_rows();
        $data['base_url']="http://sensei.pe.hu/index.php/Sadrzaj/popularni/";
        $data['per_page']=6;
        $data['num_links']=5;
        $this->pagination->initialize($data);
        
        $this->Post_model->limit= $data['per_page'];
        $this->Post_model->offset=$this->uri->segment(4);
        $postovi=$this->Post_model->filterBrojLajkova();
        $this->podaci['postovi']=$postovi;
        
        $id=$this->session->userdata('id_korisnik');
        $this->Post_model->id_korisnik=$id;
        $lajkovani_postovi=  $this->Post_model->lajkovaniPostovi();
        $this->podaci['lajkovani_postovi']=$lajkovani_postovi;
        
        $this->load->view('sadrzaj_postovi',  $this->podaci);
         $this->load->view('jumping',  $this->podaci);
         $this->podaci['anketa_podaci']=  $this->anketa();
        $this->load->view('footer',  $this->podaci);
    }
    public function novi()
    {
        $this->podaci['username']=  $this->session->userdata('username');
        $this->load->library("pagination");
        $this->load->view('header',  $this->podaci);
        $this->load->view('fiksiran',  $this->podaci);
        $this->load->helper(array('form', 'url', 'html'));
        
        $sveOblasti=$this->ucitajOblastiKorisnika();
        $this->podaci['oblasti']=$sveOblasti;
        $this->load->model('Post_model');
        
        $this->Post_model->id_korisnik=$this->session->userdata('id_korisnik');
        
        $data['total_rows']= $this->Post_model->brojPostova(); 
        $data['base_url']="http://sensei.pe.hu/index.php/Sadrzaj/novi/";
        $data['per_page']=6;
        $data['num_links']=5;
        $this->pagination->initialize($data);
        
        $this->Post_model->limit= 6;
        $this->Post_model->offset=$this->uri->segment(3);
        $postovi=$this->Post_model->filterVremePostavljanja();
        $this->podaci['postovi']=$postovi;
        
        $id=$this->session->userdata('id_korisnik');
        $this->Post_model->id_korisnik=$id;
        $lajkovani_postovi=  $this->Post_model->lajkovaniPostovi();
        $this->podaci['lajkovani_postovi']=$lajkovani_postovi;
        
        $this->load->view('sadrzaj_postovi',  $this->podaci);
        $this->load->view('jumping',  $this->podaci);
        $this->podaci['anketa_podaci']=  $this->anketa();
        $this->load->view('footer',  $this->podaci);
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
    public function comments()
    {
        $id_post=$this->uri->segment(3);
        $this->load->model("Post_model");
        
        $this->Post_model->id_post=$id_post;
        $rez=  $this->Post_model->vratiPostOblast();
        
        $this->Post_model->id_post=$id_post;
        $this->Post_model->id_korisnik=$this->session->userdata("id_korisnik");
        
        $komentari_rezultat=$this->Post_model->commentPostSimple();
        $string_komentari="";

       
      if($komentari_rezultat!=null || $komentari_rezultat!=0)
      { 
          foreach($komentari_rezultat as $r)
            {
             $phpdate = strtotime( $r->vreme_postavljanja );
             $date = date( 'Y-m-d H:i', $phpdate );
                $string_komentari.="<div class='jedan-comment'><p class='text-commentara'>".$r->komentar."</p>"
                        . "<p class='text-commentara right'>".$date."</p><b class='username-korisnika sensei'>".$r->username."</b></div>";
                
            }
      }
                    
    foreach($rez as $redic)
    {
        
        echo "<div id='wrapper-comment'>"
        . "<div class='middle-funterest-comment'>"
            . "<img src='".base_url()."". $redic->slika_post."' width='100%' height='230px' alt='".$redic->naslov."' class='slika'/>"
                    ."<div class='middle-lightup-inner'><h4 class='sensei'>".$redic->naslov."</h4></div><hr>".
                    "<div class='middle-lightup-inner middle-lightup-text bottom-line'>"
                        . "<p class='sensei'>".$redic->kratak_opis."</p>"
                  . "</div>".
                    
                    "<div class='middle-lightup-inner ispis' >".
                        "<div class='senseiLike-wrapper ".$redic->id_post.">"
                            ."<p class='sensei middle-lightup-text-bottom desno'><b>".$redic->oblast."</b></p>"
                            ."<p class='sensei middle-lightup-text-bottom desno'>".$redic->vreme_postavljanja."</p>"
                        ."</div>"                    
                    ." </div>

          </div>"
                ."<div class='write-comments'>"
                    . "<a href='' onclick='zatvori(); return false' class='zatvori'>X</a>"
                    . "<div class='comments'>"
                        .$string_komentari
                    . "</div>"
                         ."<form name='form-comment-unos' action='".base_url()."Sadrzaj/insertComment' method='POST'>"
                            ."<textarea class='comments-unos' name='comment-unos' id='comment-unos'></textarea><br/>"
                            ."<input type='hidden' id='id_post' name='id_post' value=".$redic->id_post."/>"
                            ."<input type='submit' value='comment' class='comment-button' placeholder='Comment...'/>"
                         ."</form>"
                 ."</div>"
         ."</div>";
    }

/*
    $string_komentari="";
    
    echo "<div id='wrapper-comment'>"
        . "<div class='middle-funterest-comment'>"
            . "<img src='".base_url()."". $redic->slika_post."' width='100%' height='230px' alt='".$redic->naslov."' class='slika'/>"
                    ."<div class='middle-lightup-inner'><h4 class='sensei'>".$redic->naslov."</h4></div><hr>".
                    "<div class='middle-lightup-inner middle-lightup-text bottom-line'><p class='sensei'>".$redic->kratak_opis."</p></div>".
                    
                    "<div class='middle-lightup-inner ispis' >".
                        "<div class='senseiLike-wrapper ".$redic->id_post.">"
                            ."<p class='sensei middle-lightup-text-bottom desno'><b>".$redic->oblast."</b></p>"
                            ."<p class='sensei middle-lightup-text-bottom desno'>".$redic->vreme_postavljanja."</p>"
                        ."</div>"                    
                    ." </div>

          </div>"
                ."<div class='write-comments'>"
                . "<a href='' onclick='zatvori(); return false' class='zatvori'>X</a>"
                . "<div class='comments'>"
                  
                    
                 ."</div>"
                     ."<form name='form-comment-unos' action='MESTO ZA UPIS KOMENTARA' METHOD='POST'>"
                        ."<input type='textarea' class='comments-unos' /><br/>"
                        ."<input type='submit' value='comment' class='comment-button' placeholder='Comment...'/>"
                     ."</form>"
                    ."</div>"
         ."</div>";
}*/
            
        //}
    }
    public function insertComment()
    {
        $komentar=  $this->input->post('comment-unos');
        $id_post= $this->input->post('id_post');
        $id_korisnik=$this->session->userdata('id_korisnik');
        
        $this->load->model('Post_model');
        $this->Post_model->id_korisnik=$id_korisnik;
        $this->Post_model->id_post=$id_post;
        $this->Post_model->komentar=$komentar;
        $this->Post_model->unesiKomentar();
        
        redirect('Sadrzaj');
    }
}

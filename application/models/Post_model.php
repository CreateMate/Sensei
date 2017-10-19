<?php

class Post_model extends CI_Model{
    
    public $id_post;
    public $id_korisnik;
    public $naslov;
    public $slika;
    public $opis;
    public $tekst;
    public $vreme_postavljanja;
    public $broj_lajkova;
    public $id_oblastt;
    public $limit;
    public $offset;
    public $komentar;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function vratiPost()
    {
        return $this->db->query("SELECT * FROM post WHERE id_post=".$this->id_post)->result();
    }
    public function vratiPostOblast()
    {
        return $this->db->query("SELECT * FROM post JOIN oblast ON post.id_oblast=oblast.id_oblast "
                . "WHERE id_post=".$this->id_post)->result();
    }
    public function brojPostova()
    {
        $query= $this->db->query("SELECT * FROM  post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_oblast ON "
                . "oblast.id_oblast=korisnik_oblast.id_oblast WHERE id_korisnik=".$this->id_korisnik);
        return $query->num_rows();
    }
    public function commentPostSimple()
    {
         return $this->db->query("SELECT * FROM post JOIN korisnik_post_komentar on post.id_post=korisnik_post_komentar.id_post JOIN korisnik ON korisnik.id_korisnik=korisnik_post_komentar.id_korisnik"
                . " WHERE korisnik_post_komentar.id_post=".$this->id_post)->result();
    }
    public function unesiKomentar()
    {
        $this->db->insert('korisnik_post_komentar',array('id_korisnik'=>$this->id_korisnik, 'id_post'=>  $this->id_post, 'komentar'=>  $this->komentar,'vreme_postavljanja'=>  date("Y-m-d H:i:s")));
    }
    public function commentPost()
    {
        //$string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_post ON post.id_post=korisnik_post.id_post JOIN "
        //        . "korisnik_oblast ON korisnik_oblast.id_korisnik=korisnik_post.id_korisnik WHERE korisnik_post.id_post=".$this->id_post." "
         //       . "AND korisnik_post.id_korisnik=".$this->id_korisnik." GROUP BY korisnik_post.id_post ";
        
        $string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_post_komentar ON post.id_post=korisnik_post_komentar.id_post JOIN "
                . "korisnik_oblast ON korisnik_oblast.id_korisnik=korisnik_post_komentar.id_korisnik WHERE korisnik_post_komentar.id_post=".$this->id_post." "
                . " GROUP BY korisnik_post_komentar.id_post ";
        $upit=$this->db->query($string);
        return $upit->row();
    }
    public function sviPostovi($sve_oblasti)
    {
        $string="";
        for($i=0; $i<count($sve_oblasti); $i++)
        {
            if($i==0)
            {
                $string.="WHERE post.id_oblast = ".$sve_oblasti[$i]->id_oblast;
            }
            else
            {
                $string.=" OR post.id_oblast = ".$sve_oblasti[$i]->id_oblast;
            }
        }
       if(isset($this->limit))
       {
           $string.=" LIMIT ".$this->limit;
       }
       if(isset($this->offset))
       {
           $string.=" OFFSET ".$this->offset;
       }
       
            $query=$this->db->query("SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast ".$string);
            $postovi=$query->result();
            
        return $postovi;
        //on ovde vraca ono sto treba 
    }
    public function lajkovaniPostovi()
    {
        $query=$this->db->query("SELECT * FROM korisnik_post WHERE id_korisnik=".$this->id_korisnik);//SELECT * FROM korisnik_post WHERE id_korisnik=".$this->id_korisnik
        $postovi=$query->result();
            
        return $postovi;
    }
    public function sviPostoviPrikazSaLajkom($sve_oblasti)
    {
        $string="";
        for($i=0; $i<count($sve_oblasti); $i++)
        {
            if($i==0) //SELECT * FROM post join post_oblast on post.id_post=po.id_post JOIN oblast ON po.id_oblast=oblast.id_oblast 
            //join korisnik_oblast ON oblast.id_oblast=korisnik_oblast.id_oblast JOIN korisnik ON korisnik.id_korisnik=korisnik_oblast.id_korisnik JOIN korisnik_post 
            //ON korisnik.id_korisnik = korisnik_post.id_korisnik where id_korisnik=sesija;
            {
                $string.=" GROUP BY post.id_post HAVING (post.id_oblast = ".$sve_oblasti[$i]->id_oblast." ";
            }
            
            else
            {
                $string.=" OR post.id_oblast = ".$sve_oblasti[$i]->id_oblast." ";
            }
            if($i==count($sve_oblasti)-1)
            {
                $string.=" ) ";
            }
        }
        
       if(isset($this->limit))
       {
           $string.=" LIMIT ".$this->limit;
       }
       if(isset($this->offset))
       {
           $string.=" OFFSET ".$this->offset;
       }
       
            $query=$this->db->query("SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_oblast ON "
                    . "oblast.id_oblast=korisnik_oblast.id_oblast ".$string." ");
       
               // $query=$this->db->query("SELECT * FROM post LEFT OUTER JOIN korisnik_post ON post.id_post=korisnik_post.id_post JOIN korisnik ON korisnik.id_korisnik=korisnik_post.id_korisnik".$string." ");
                        //. " LEFT JOIN korisnik_oblast JOIN oblast ON korisnik_oblast.id_oblast=oblast.id_oblast post.id_oblast=oblast.id_oblast ".$string." ");
                
            $postovi=$query->result();
            
        return $postovi;
        //on ovde vraca ono sto treba 
    }
    public function filterPost()
    { 
         $string=" SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast WHERE post.id_oblast=".$this->id_oblastt; 
        
        /*$string=" SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast LEFT JOIN korisnik_oblast ON "
                    . "oblast.id_oblast=korisnik_oblast.id_oblast join korisnik_post ON korisnik_post.id_korisnik=korisnik_oblast.id_korisnik "
                 . "GROUP BY post.id_post HAVING post.id_oblast=".$this->id_oblastt;*/
        
       if(isset($this->limit))
       {
          
           $string.=" LIMIT ".$this->limit;
       }
       if(isset($this->offset))
       {
           
           $string.=" OFFSET ".$this->offset;
       }
//       redirect($string);
             $query=$this->db->query($string);
             return $query->result();
         
         
    }
    public function filterLike()
    {
        $string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_oblast ON oblast.id_oblast=korisnik_oblast.id_oblast WHERE id_korisnik=".$this->id_korisnik;
        if($this->naslov!="")
        {
            $string.=" AND post.naslov LIKE '%".$this->naslov."%' ";
        }
        if($this->id_oblastt)
        {
            $string.=" AND post.id_oblast=".$this->id_oblastt;
        }
        $upit=$this->db->query($string);
        return $upit->result();
    }
    public function filterBrojLajkova()
    {
        //$string=" SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast LEFT JOIN korisnik_oblast ON "
        //            . "oblast.id_oblast=korisnik_oblast.id_oblast join korisnik_post ON korisnik_post.id_korisnik=korisnik_oblast.id_korisnik "
          //       . "GROUP BY post.id_post HAVING post.id_oblast=".$this->id_oblastt;
        
        $string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_oblast ON"
                . " oblast.id_oblast=korisnik_oblast.id_oblast WHERE korisnik_oblast.id_korisnik=".$this->id_korisnik."  AND broj_lajkova>5 GROUP BY post.id_post ";
        $upit=$this->db->query($string);
        return $upit->result();
    }
    public function filterVremePostavljanja()
    {
       // $string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast JOIN korisnik_oblast ON"
         //       . " oblast.id_oblast=korisnik_oblast.id_oblast join korisnik_post ON korisnik_post.id_korisnik=korisnik_oblast.id_korisnik "
           //     . " GROUP BY post.id_post HAVING korisnik_oblast.id_korisnik=".$this->id_korisnik.""
             //   . " ORDER BY vreme_postavljanja ASC";
        
        $string="SELECT * FROM post JOIN oblast on post.id_oblast=oblast.id_oblast LEFT JOIN korisnik_oblast ON "
                . "oblast.id_oblast=korisnik_oblast.id_oblast WHERE korisnik_oblast.id_korisnik=".$this->id_korisnik." "
                . " GROUP BY post.id_post "
                . " ORDER BY vreme_postavljanja ASC";
       if(isset($this->limit))
       {
           $string.=" LIMIT ".$this->limit;
       }
       if(isset($this->offset))
       {   
           $string.=" OFFSET ".$this->offset;
       }
         $upit=$this->db->query($string);
        return $upit->result();
    }
    
    public function oblastiPosta()
    {
        $this->db->select("*");
        $this->db->from("oblast");
        $this->db->join("post_oblast","oblast.id_oblast = post_oblast.id_oblast");
        $this->db->where("id_post",$this->id_post);
        
        return $this->db->get();
    }
    public function dodajLikeVise()
    {
        $query=$this->db->query("SELECT broj_lajkova from post WHERE id_post=".$this->id_post);
        $broj=$query->row(0);
        
        $brojic=$broj->broj_lajkova+1;
        $podaci=array('broj_lajkova'=>$brojic);
        
        $this->db->where('id_post',  $this->id_post);
        $this->db->update('post',$podaci);
        
       
        $this->db->insert('korisnik_post',array('id_korisnik'=>$this->id_korisnik, 'id_post'=>  $this->id_post, 'lajk'=>1));
    }
    public function oduzmiLike()
    {
        $query=$this->db->query("SELECT broj_lajkova from post WHERE id_post=".$this->id_post);
        $broj=$query->row(0);
        
        $brojic=$broj->broj_lajkova-1;
        $podaci=array('broj_lajkova'=>$brojic);
        
        $this->db->where('id_post',  $this->id_post);
        $this->db->update('post',$podaci);
    }
    public function sviPostoviAdmin()
    {
        $query=$this->db->query("SELECT * FROM post JOIN oblast ON post.id_oblast=oblast.id_oblast");
        return $query->result();
    }
    public function izbrisiPost()
    {
        $this->db->delete("post",array('id_post'=>  $this->id_post));
    }
    public function upisiPost()
    {
        $this->db->insert('post',array('naslov'=>  $this->naslov, 'slika_post'=>$this->slika,'kratak_opis'=>  $this->tekst,'tekst'=> $this->tekst,'vreme_postavljanja'=>date("Y-m-d H:i:s"),'broj_lajkova'=>0, 'id_oblast'=>$this->id_oblastt));
    }
    public function izmeniPost()
    {
        $data=array(
            'naslov'=>  $this->naslov,
            'slika_post'=>$this->slika,
            'kratak_opis'=>  $this->tekst,
            'tekst'=> $this->tekst,
            'vreme_postavljanja'=>date("Y-m-d H:i:s"),
            'broj_lajkova'=>  $this->broj_lajkova,
            'id_oblast'=>$this->id_oblastt
        );
        $this->db->where('id_post',$this->id_post);
        $this->db->update('post',$data);
    }
}

<div id="wrapper">
	
<article id="sadrzaj">
			
  <?php $lajkovan=false; ?>
  <?php if(isset($postovi)): ?>
                              
    <?php foreach($postovi as $post): ?>
    <div class="middle-funterest">
           <img src="<?php echo $base_url; ?><?php echo $post->slika_post; ?>" width="100%" height="230px" alt="<?php echo $post->naslov; ?>" class="slika"/>
             <div class="middle-lightup-inner"><h4 class="sensei"> <?php echo $post->naslov; ?></h4></div><hr>
              <div class="middle-lightup-inner text middle-lightup-text"><p class="sensei"><?php echo $post->kratak_opis; ?></p></div><hr>
               <div class="middle-lightup-inner ispis" >
                       <div class="senseiLike-wrapper <?php echo $post->id_post; ?>">
                           
                           <?php foreach($lajkovani_postovi as $lajkovaniPost): ?>
                               <?php if( $post->id_post==$lajkovaniPost->id_post): ?>
                                 <?php $lajkovan=true; ?>
                               <?php endif; ?>                           
                           <?php endforeach; ?>
                           
                           <?php if(!$lajkovan): ?>
                                <a href="#" onClick="ajaxLike(<?php echo $post->id_post;?>);return false" class='senseiLike<?php echo $post->id_post;?> levo' id='senseiLike' name='senseiLike'>
                                  <img src="<?php echo $base_url;?>images/up.png" alt="sensei like" class="unliked"/>
                                </a>
                                <input type="hidden" name="hiddenCuvarLike" id="<?php echo $post->id_post ?>" value="<?php echo $lajkovan; ?>" />
                                
                           <?php else: ?>
                                
                                  <img src="<?php echo $base_url;?>images/upLiked.png" alt="sensei like" class="liked"/>
                                <input type="hidden" name="hiddenCuvarLike" id="<?php echo $post->id_post ?>" value="<?php echo $lajkovan; ?>" />
                                <?php $lajkovan=false; ?>
                           <?php endif; ?>
                           
                       </div>
                   
                   <div class="broj_lajkova"><p class="sensei green povecaj<?php echo $post->id_post;?>"><b><?php echo $post->broj_lajkova; ?></b></p></div>
                   
                    <div class="senseiLike-wrapper <?php echo $post->id_post; ?>">
                        <?php if(false==true): ?>
                            <a href="#" onClick="ajaxDislike(<?php echo $post->id_post;?>);return false" class='senseiLike levo' id='senseiLike' name='senseiLike'>
                               <img src="<?php echo $base_url;?>images/down.png" alt="sensei like" />
                           </a>
                        <?php endif; ?>
                    </div>
                       <p class="sensei middle-lightup-text-bottom desno"><b><?php echo $post->oblast?></b></p>
                        <p class="sensei middle-lightup-text-bottom desno"><?php echo $post->vreme_postavljanja;?></p>
                </div>
              <a href="" onclick="ajaxPrikazPostaKomentar(<?php echo $post->id_post; ?>);return false" class="comment-text">Comment...</a>
    </div>
                                       
    <?php endforeach; ?>
                                
                           
     <?php endif; ?>
    
	 <div id="pagination">
        <p class="sensei paginationLinks"><?php echo $this->pagination->create_links(); ?></p>
    </div>
    
    <div id="lightbox">
			
        

        <!--<div class="zatvori" onClick="zatvori()">
                <span><img src="ikone/Untitled-3.png" alt="close"></span>
        </div>-->
    </div>
    
 </article>	
   
   
		<?php if(isset($hidden_tag_name)):?>
                <form id="skrivenaForma">
                     <?php echo form_hidden($hidden_tag_name, $hidden_tag_value) ;?>
                </form>
                 <?php endif; ?>
</div>
	
<body>
    <?php $follow=false; ?>
    
    <?php if(isset($id_korisnika_registracija)):?>
        <input type="hidden" name="hiddenIdKorisnika" id="hiddenIdKorisnika" value="<?php echo $id_korisnika_registracija; ?>"/>
    <?php endif; ?>
        
 <div id="container">
    <h1 class="wrap-out wrap-out-margin-top">Edit your account</h1>
	<div class="login-form">
		<h1 class="wrap-in">Account settings</h1>		
                <?php if(isset($sve_oblasti)):?>
                <?php foreach ($sve_oblasti as $oblast): ?>
                    <div class="form-group">
                        
                        <input type="text" name="tbOblast" value="<?php echo $oblast->oblast; ?>" disabled class="form-control" />
                        
                        <?php if(isset($korisnikove_oblasti)):?>
                            <?php foreach($korisnikove_oblasti as $korisnik_oblast): ?>
                                <?php if($korisnik_oblast->id_oblast==$oblast->id_oblast):?>
                                    <?php $follow = true; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if($follow): ?>
                            <a href="" class="follow-href-">
                             <img onClick="ajaxUnFollow(<?php echo $oblast->id_oblast;?>);return false" src="<?php echo $base_url;?>images/unfollow_small.png" class="unfollow<?php echo $oblast->id_oblast;?> follow-image" alt="unfollow button" />
                             <img onClick="ajaxFollow(<?php echo $oblast->id_oblast;?>);return false" src="<?php echo $base_url;?>images/follow_small.png" class="follow<?php echo $oblast->id_oblast;?> follow-image" alt="follow button" />
                            </a>
                            <?php $follow=false; ?>
                        <?php else: ?>
                        <a href="" class="follow-href-<?php echo $oblast->id_oblast;?>">
                             <img onClick="ajaxFollow(<?php echo $oblast->id_oblast;?>);return false" src="<?php echo $base_url;?>images/follow_small.png" class="follow<?php echo $oblast->id_oblast;?> follow-image" alt="follow button" />
                             <img onClick="ajaxUnFollow(<?php echo $oblast->id_oblast;?>);return false" src="<?php echo $base_url;?>images/unfollow_small.png" class="unfollow<?php echo $oblast->id_oblast;?> follow-image " alt="unfollow button" />
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if(isset($id_korisnika_registracija)):?>
                <a href="http://localhost/Sajt/Sadrzaj">
                    <input type="button" name="btnRegistracija" id="btnRegistracija" class="log-btn" value="Create"><br/><br/>
                </a>
                <?php else: ?>
                <a href="http://localhost/Sajt/Sadrzaj">
                    <input type="button" name="btnRegistracija" id="btnRegistracija" class="log-btn" value="Change"><br/><br/>
                </a>
                <?php endif; ?>
		  <span class="greska"><?php echo validation_errors(); ?></span>
		  
		 
        </div>
   </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript">
    function ajaxFollow(id)
    {
        var xhttp;
  
        if (window.XMLHttpRequest) 
        {

          xhttp = new XMLHttpRequest();
          } 
          else 
          {

            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          
            var id_kor = $("#hiddenIdKorisnika").val();
            if(id_kor!=0 && id_kor!="" && id_kor!=null)
            {
                xhttp.open("POST", base_url+"Account/follow/"+id+"/"+id_kor, true);
            }
            else
            {
                xhttp.open("POST", base_url+"Account/follow/"+id, true);
            }
           
            xhttp.send();
            xhttp.onreadystatechange = function() 
            {
                if (xhttp.readyState == 4 && xhttp.status == 200) 
                {
                    $(".follow"+id).addClass("none");
                    $(".unfollow"+id).removeClass("none");
                }
            }       
    }
    function ajaxUnFollow(id)
    {
       var xhttp;
  
        if (window.XMLHttpRequest) 
        {

          xhttp = new XMLHttpRequest();
          } 
          else 
          {

          xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            var id_kor = $("#hiddenIdKorisnika").val();
            
            if(id_kor!=0 && id_kor!="" && id_kor!=null)
            {
                 xhttp.open("POST", "http://localhost/Sajt/Account/unfollow/"+id+"/"+id_kor, true);
            }
            else
            {
                 xhttp.open("POST", "http://localhost/Sajt/Account/unfollow/"+id, true);
            }
            xhttp.send();
            xhttp.onreadystatechange = function() 
            {
                if (xhttp.readyState == 4 && xhttp.status == 200) 
                {
                    $(".unfollow"+id).addClass("none");
                    $(".follow"+id).removeClass("none");
                }
            }
    }
    </script>
        <script src="<?php echo $base_url;?>js/index.js"></script>
  </body>
</html>
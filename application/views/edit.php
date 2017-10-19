<body>
    
    <h1 class="wrap-out wrap-out-margin-top">Edit your account</h1>
	<div class="login-form topbar">
		<h1 class="wrap-in">Privacy settings</h1>
                <h3><?php validation_errors();?></h3>
		<?php print form_open('edit',$form_tag_atributi); ?>
                
                    <div class="form-group log-status-email">
                        <?php print form_input($email_atributi); ?>
                       <i class="fa fa-envelope"></i>
                     </div>
		 
                    <div class="form-group log-status-user">
                        <?php print form_input($username_atributi); ?>
                      <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group log-status-pass">
                        <?php print form_password($password_atributi); ?>
                      <i class="fa fa-lock"></i>
                    </div>
		 
		  <div class="form-group log-status">
                   <?php print form_password($confirm_password_atributi); ?>
		   <i class="fa fa-lock"></i>
		 </div>
                
                  <?php if(isset($greska_baza)): ?>
                    <span class="greska"><?php print $greska_baza; ?></span>
                  <?php endif; ?>
		  <span class="greska"><?php echo validation_errors(); ?></span>
		  
		 <input type="submit" name="btnRegistracija" id="btnRegistracija" class="log-btn" value="Change"><br/><br/>
		  <?php print form_close(); ?>
        </div>
   
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo $base_url;?>js/index.js"></script>
  </body>
</html>
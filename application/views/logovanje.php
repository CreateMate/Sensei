<body>

    <h1 class="wrap-out">Welcome to Sensei</h1>
    <div class="login-form">
        
     <h1 class="wrap-in">Sign in</h1>
     
     <?php print form_open($base_url.'logovanje/login', $form_tag_atributi);?>
     <div class="form-group log-status-user">
         <?php print form_input($username_atributi); ?>
       
       <i class="fa fa-user"></i>
     </div>
     
     <div class="form-group log-status-pass">
         <?php print form_password($password_atributi); ?>
       
       <i class="fa fa-lock"></i>
     </div>
     
     <?php if($this->session->flashdata('poruka')):?>
     
         <span class="alert"><?php echo $this->session->flashdata('poruka'); ?></span>
    
     <?php endif;?>
         
      <a class="link" href="<?php echo base_url(); ?>Logovanje/lostPassword">Lost your password?</a>
      <input type="submit" class="log-btn" value="Log in" name="btnLogin" id="btnLogin" /><br/><br/><br/>
      <a href="<?php print base_url(); ?>registracija"><button type="button" class="log-btn" >Make your account</button></a>
     
   </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php print base_url(); ?>js/index.js"></script>    
  </body>
</html>

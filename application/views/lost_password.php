<body>

   <!-- <h1 class="Message">Type in your email so we can send<br/> you a new password. </h1>-->
    <div class="login-form">
        
     <h1 class="wrap-in wrap-in-lost-password">Type your email so we can send you a new password</h1>
     <?php if(isset($form_tag_atributi)):?>
     <?php print form_open($base_url.'logovanje/lostPassword', $form_tag_atributi);?>
     <div class="form-group log-status-user topbar-moved">
         <?php print form_input($username_atributi); ?>
       
       <i class="fa fa-user"></i>
     </div>
     
      <input type="submit" class="log-btn" value="Send" name="btnLogin" id="btnLogin" /><br/><br/><br/>
      <?php endif; ?>
   </div>
   
   
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><h1 class="wrap-in"><?php echo validation_errors(); ?>    </h1>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php print base_url(); ?>js/index.js"></script>
    
  </body>
</html>

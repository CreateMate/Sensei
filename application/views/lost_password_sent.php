<body>

   <!-- <h1 class="Message">Type in your email so we can send<br/> you a new password. </h1>-->
    <div class="login-form">
        
     
     <h1 class="wrap-in wrap-in-lost-password">Your new password has been sent. Check your email account.</h1>
     <a href="<?php echo base_url(); ?>Logovanje">
         <input type="button" class="log-btn" value="Login" name="btnLogin" id="btnLogin" /><br/><br/><br/>
     </a>
   
   </div>
   
   
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><h1 class="wrap-in"><?php echo validation_errors(); ?>    </h1>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php print base_url(); ?>js/index.js"></script>
    
  </body>
</html>

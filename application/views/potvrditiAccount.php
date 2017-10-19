<body>

    <h1 class="wrap-out sensei">Validate your Sensei account</h1>
    <div id="wrapper" class="wrapp">
        
   

     <div>
        <h2 class="sensei sivo"> To confirm your account and proceed, go to email account you just entered and click on the confirmation link. </h2><br/>
        <form method="POST" id="formResend" name="formResend" action="<?php echo base_url();?>registracija/resend">
            <input type="hidden" id="username" name="username" value="<?php print $username ?>"/>
            <input type="hidden" id="email" name="email" value="<?php echo $email; ?>"/>
            <input type="hidden" id="username" name="username" value="<?php echo $code; ?>"/>
            <input type="submit" id="btnResend" class="log-btn" value="Resend email" >
        </form>
     </div>
   </div>
   
     
  </body>
</html>

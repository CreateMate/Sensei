<body>
   <script src="<?php echo $base_url;?>js/oblast_posta.js"></script>
             <h1 class="wrap-out text">Learn from Sensei</h1>
             <h1 class="text subscribe-text">Choose and subscribe your account to these sections, and learn many interesting facts about them.</h1>
             <div id="wrapper">
                <?php echo form_open('Biranje_oblasti',$form_tag); ?>
             
                <?php if(isset($oblasti)):?>
                    <?php foreach($oblasti as $oblast):?>
             
                        <a onClick="naKlik(<?php echo $oblast['id_oblast']; ?>);" id="<?php echo $oblast['id_oblast']; ?>">
                            <div class="oblast-wrapper">
                                
                                <div class="oblast <?php echo $oblast['id_oblast']; ?> levo">
                                    <h2 class="naslov"><?php echo $oblast['naslov']; ?></h2>
                                        <div class="oblast-slika">
                                            <img src="<?php echo $base_url.$oblast['slika_oblast']; ?>" alt="<?php echo $oblast['naslov']; ?>" class="slika"/>
                                            <input type="checkbox" id="sakriveno<?php echo $oblast['id_oblast']; ?>" class="nevidljivi" name="check_list[]" value=0 />
                                        </div>
                                     
                                </div>
                                
                            </div>
                        </a>
                            
                    <?php endforeach;  ?>
                <?php endif; ?>
                    <?php echo form_hidden("hiddenUsername", $hidden); ?>
                    <input type="submit" value="Start Using" id="btnStart" name="btnStart" /><br/><br/><br/>
                    
                    <h1><?php echo validation_errors(); ?></h1>
                <?php echo form_close(); ?>
                
        </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo $base_url;?>js/biranje.js"></script>
  </body>
</html>
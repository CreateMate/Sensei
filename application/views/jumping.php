<div class="clear"></div>
		<div id="jumping" class="prikaz">
                    <?php if(isset($oblasti)): ?>
                        <ul>
                            
                            <?php foreach($oblasti as $oblast): ?>
                             <li><?php print anchor("Sadrzaj/field/".$oblast->id_oblast, "".$oblast->oblast,"class='jumping-link sensei'"); ?></li>
                            <?php endforeach; ?>
                               <br/>
                               <li><?php print anchor("Sadrzaj/popularni", "Most Popular", "class='jumping-link sensei'"); ?></li>
                               <li><?php print anchor("Sadrzaj/novi", "Newest First", "class='jumping-link sensei'"); ?></li>
                               <li><?php print anchor("Sadrzaj", "All Posts","class='jumping-link sensei'"); ?></li>
                               <br/>
                               <?php if($this->session->userdata('uloga')=='admin'):?>
                                 <li><?php print anchor("Admin", "Admin","class='jumping-link sensei'"); ?></li>
                               <?php endif; ?>
                               
                               <li><?php print anchor("Edit", "Privacy settings","class='jumping-link sensei'"); ?></li>
                               <li><?php print anchor("Account", "Account settings","class='jumping-link sensei'"); ?></li>
                              <li><?php print anchor("Logovanje/logout", "Logout","class='jumping-link logout sensei'"); ?></li><br/>
                    <?php else: ?>
                    <h1>No selected Facts!</h1>
                    <?php endif; ?>
                         </ul>
                    
		</div>
      
        <script src="<?php echo $base_url;?>js/popup.js"></script>
        
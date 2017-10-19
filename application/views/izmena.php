
<div id="wrapper">
       <?php if($post):?>
        <div class="admins">
            <h2 class="sensei">Post</h2>
            <?php echo form_open_multipart("Admin/izmeniPostSubmit", $form_tag_atributi);?>
            <h4>Naslov</h4><br/>
            <?php echo form_input($naslov_tag); ?><br/>
            <h4>Tekst</h4><br/>
            <?php echo form_textarea($tekst_tag_atributi); ?><br/>
            <h4>SLIKA</h4>
            <input type="file" name="fileSlika" id="fileSlika"/>
            <h4>Broj Lajkova</h4><br/>
            <?php echo form_input($broj_lajkova_tag_atributi); ?><br/> 
            <h4>Oblasti</h4><br/>
            <select name="ddlOblasti">
                <?php foreach ($oblastiSve as $value): ?>
                <option value="<?php echo $value->id_oblast; ?>"><?php echo $value->oblast; ?></option>
                <?php endforeach;?>
            </select><br/><br/>
            <?php echo form_hidden("idPost", $idPost);?>
            <input type="submit" name="btnAnketa" id="btnAnketa" value="Izmeni"/>
        <?php echo form_close();?>
            </div>
    <?php endif;?>
        
    <?php if($korisnik):?>
        <div class="admins">
            <h2 class="sensei">Korisnik</h2>
            <form action="<?php echo base_url();?>Admin/izmeniKorisnikaSubmit" method="POST" >
           
                <input type="text" id="tbUsername" name="tbUsername" class="UserName" placeholder="<?php echo $username; ?>"/><br/><br/>
                <input type="text" id="tbPassword" name="tbPassword" class="UserName" placeholder="<?php echo $password; ?>"/><br/><br/>
                <input type="text" id="tbEmail" name="tbEmail" class="UserName" placeholder="<?php echo $email; ?>"/><br/><br/>
                 <input type="text" id="tbStatus" name="tbStatus" class="UserName" placeholder="<?php echo $status; ?>"/><br/><br/>
                <select name="ddlUloga" id="ddlUloga" class="UserName">
                    <option value="0">Izaberi..</option>
                    <option value="1">Admin</option>
                    <option value="2">Moderator</option>
                    <option value="3">Korisnik</option>
                </select><br/><br/>
                <input type="hidden" name="idKorisnik" value="<?php echo $idKorisnik; ?>"/>
                <input type="submit" id="btnKorisnikRegistracija" name="btnKorisnikRegistracija" value="Upisi" />
                
                </form>
               
            </div>
    
    <?php endif;?>
    
     <?php if($anketa):?>
    <div class="admins">
        <p class="wrap-in">Anketa</p>
        
        <?php echo form_open("Admin/izmeniAtributSubmit", $form_tag_atributi);?>
        <?php echo form_textarea($tekst_tag_atributi); ?><br/>
        <?php echo form_hidden("idAnketa", $idAnketa);?>
        <input type="submit" name="btnAnketa" id="btnAnketa" value="Izmeni"/>
    <?php echo form_close();?>
    </div>
    <?php endif;?>
</div>

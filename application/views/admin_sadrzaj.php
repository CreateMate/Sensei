<div id="wrapper">
    <?php if(isset($sviKorisnici)):?>
    <div class="admins korisnik">
        <h3 class="wrap-in sensei">Korisnik</h3>
        <table border="1">
        <tr><th>Username</th><th>Email</th><th>Uloga</th><th>Status</th><th>Datum Registracije</th></tr>
        <?php foreach ($sviKorisnici as $korisnik): ?>
            <tr>
                <td><?php echo $korisnik->username; ?></td><td><?php echo $korisnik->email; ?></td><td><?php echo $korisnik->uloga; ?></td>
                <td><?php echo $korisnik->status; ?></td><td><?php echo $korisnik->datum_registracije; ?></td>
                <td><?php echo anchor("Admin/izbrisiKorisnika/".$korisnik->id_korisnik, "Izbrisi");?></td>
                <td><?php echo anchor("Admin/izmeniKorisnika/".$korisnik->id_korisnik, "Izmeni");?></td>
            </tr>
        <?php endforeach; ?>
        </table>
        <div class="upis korisnik_upis">
            <form action="Admin/upisiKorisnika" method="POST" class="form" name="formUpisKorisnika">
                <input type="text" id="tbUsername" name="tbUsername" class="UserName" placeholder="Username"/><br/><br/>
                <input type="text" id="tbPassword" name="tbPassword" class="UserName" placeholder="Password"/><br/><br/>
                <input type="text" id="tbEmail" name="tbEmail" class="UserName" placeholder="Email"/><br/><br/>
                <select name="ddlUloga" id="ddlUloga" class="UserName">
                    <option value="0">Izaberi..</option>
                    <option value="1">Admin</option>
                    <option value="2">Moderator</option>
                    <option value="3">Korisnik</option>
                </select><br/><br/>
                <input type="submit" id="btnKorisnikRegistracija" name="btnKorisnikRegistracija" value="Upisi" />
            </form>
        </div>
    </div>
    <?php endif;?>
    
    <?php if(isset($oblastiTabela)):?>
    <div class="admins oblast">
         <h3 class="wrap-in sensei">Oblast</h3>
        <table border="1">
        <tr><th>Oblast</th><th>Slika</th></tr>
        <?php foreach ($oblastiTabela as $oblasti): ?>
            <tr>
                <td><?php echo $oblasti->oblast; ?></td><td><?php echo $oblasti->slika_oblast; ?></td>
                <td><?php echo anchor("Admin/izbrisiOblast/".$oblasti->id_oblast, "Izbrisi");?></td>
            </tr>
        <?php endforeach; ?>
        </table>
        <div class="upis oblast_upis">
            <form action="Admin/upisiOblast" method="POST" class="form" name="formUpisOblasti"  enctype="multipart/form-data">
                <input type="text" id="tbOblast" name="tbOblast" class="UserName" placeholder="Oblast"/><br/><br/>
                <input type="file" id="fileOblastSlika" name="fileOblastSlika" class="UserName" /><br/><br/>
                
                <input type="submit" id="btnKorisnikRegistracija" name="btnKorisnikRegistracija" value="Upisi" />
            </form>
        </div>
    </div>
    <?php endif;?>
    
    <?php if(isset($postovi)):?>
    <div class="admins post">
        <h3 class="wrap-in sensei">Post</h3>
        <table border="1">
        <tr><th>Naslov</th><th>Slika posta</th><th>Tekst</th><th>Vreme postavljanja</th><th>Broj lajkova</th><th>Oblast</th></tr>
        <?php foreach ($postovi as $post): ?>
            <tr>
                <td><?php echo $post->naslov; ?></td><td><?php echo $post->slika_post; ?></td><td><?php echo $post->tekst; ?></td>
                <td><?php echo $post->vreme_postavljanja; ?></td><td><?php echo $post->broj_lajkova; ?></td><td><?php echo $post->oblast; ?></td>
                <td><?php echo anchor("Admin/izbrisiPost/".$post->id_post, "Izbrisi");?></td>
                <td><?php echo anchor("Admin/izmeniPost/".$post->id_post, "Izmeni");?></td>
            </tr>
        <?php endforeach; ?>
        </table>
         <div class="upis postovi_upis">
            <form action="Admin/upisiPost" method="POST" class="form" name="formUpisPosta" enctype="multipart/form-data">
                <textarea type="text" id="tbNaslov" name="tbNaslov" class="UserName" placeholder="Naslov"></textarea><br/><br/>
                <input type="file" id="filePostSlika" name="filePostSlika" class="UserName" /><br/><br/>
                <textarea type="text" id="tbTekst" name="tbTekst" class="UserName" placeholder="Tekst"></textarea><br/><br/>
                <select name="ddlOblast" id="ddlOblast" class="UserName">
                    <option value="0">Izaberite...</option>
                   <?php foreach($oblastiTabela as $oblast):?>
                    <option value="<?php echo $oblast->id_oblast; ?>"><?php echo $oblast->oblast; ?></option>
                   <?php endforeach;?>
                </select><br/><br/>
                <input type="submit" id="btnPost" name="btnPost" value="Upisi" />
            </form>
        </div>
    </div>
    <?php endif;?>
    
     <?php if(isset($ankete)):?>
    <div class="admins oblast">
         <h3 class="wrap-in sensei">Anketa</h3>
        <table border="1">
        <tr><th>Anketa tekst</th><th>Izbrisi</th><th>Izmeni</th></tr>
        <?php foreach ($ankete as $anketa): ?>
            <tr>
                <td><?php echo $anketa->tekst; ?></td>
                <td><?php echo anchor("Admin/izbrisiAnketu/".$anketa->id_anketa, "Izbrisi");?></td>
                <td><?php echo anchor("Admin/IzmeniAnketu/".$anketa->id_anketa, "Izmeni");?></td>
            </tr>
        <?php endforeach; ?>
        </table>
         <div class="upis oblast_upis">
            <form action="Admin/upisiAnketu" method="POST" class="form" name="formUpisOblasti"  enctype="multipart/form-data">
                <textarea type="text" id="tbAnketa" name="tbAnketa" class="UserName" placeholder="Anketa"></textarea><br/><br/>
                
                <input type="submit" id="btnAnketa" name="btnAnketa" value="Upisi" />
            </form>
        </div>
    </div><br/>
    <?php endif;?>
    
</div><br/><br/>
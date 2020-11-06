<h1>Récupération de mot de passe</h1>
<h2>Récupération de code de vérification</h2>
<article>
    <form method="post" action="<?php echo hlien("authentification","recupcode")?>">
        <div class="form-group">
            <label for="verif_code">Code : </label>
            <input type="text" name="verif_code" placeholder="Code de vérification">
        </div>
            <input type="submit" class="btn btn-success" name="verif_submit" value="Envoyer code de vérification">
    </form>
   
    <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo "<br />"; } ?>
</article>
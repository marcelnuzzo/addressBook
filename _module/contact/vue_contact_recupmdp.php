<h1>Récupération de mot de passe</h1>
<article>
    <form method="post" action="<?php echo hlien("contact","recupmdp")?>">
        <div class="form-group">
            <label for="recup_mail">Mail : </label>
            <input type="email" name="recup_mail" placeholder="Votre adresse mail">
        </div>
            <input type="submit" class="btn btn-success" name="recup_submit" value="Envoyer mail de récup">
    </form>
    <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo "<br />"; } ?>
</article>
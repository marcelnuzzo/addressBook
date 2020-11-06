<h1>Récupération de mot de passe</h1>
<h2>Réinitialisation du mot de passe</h2>
<article>
    <form method="post" action="<?php echo hlien("authentification","initmdp")?>">
        <div class="form-group">
            <label for="change_mdp">Nouveau mot de passe : </label>
            <input type="password" name="change_mdp" placeholder="Saisissez votre nouveau mot de passe">
        </div>
        <div class="form-group">
            <label for="change_mdpc">Confirmation mot de passe : </label>
            <input type="password" name="change_mdpc" placeholder="Veuillez confirmer le mot de passe">
        </div>
            <input type="submit" class="btn btn-success" name="change_submit" value="Réinitialiser mot de passe">
    </form>
   
    <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo "<br />"; } ?>
</article>
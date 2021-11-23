<?php session_start(); ?>
    <div class="row text-center justify-content-center">
        <div class="col-6">
            <?php if (!empty($_SESSION['inscription'])) {
                foreach ($_SESSION['inscription'] as $error) {?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php }
            }; ?>
            <h2>Inscription</h2>
            <form action="index.php?app=inscriptionpost" method="post" class="mt-4">
            <div class="mb-3">
                <label for="mail" class="form-label">Adresse mail</label>
                <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" autocomplete="off" onkeyup="logKey()" class="form-control" name="password" id="password">
            </div>
            <div class="alert alert-secondary" id="passwordStrength">Jauge de fiabilité du mot de passe</div>
            <div class="mb-3">
                <label for="password2" class="form-label">Répétez le mot de passe</label>
                <input type="password" autocomplete="off" onkeyup="checkpass()" class="form-control" name="password2" id="password2">
                <div class="mt-2 alert alert-secondary" id="egalpass">Vérification de l'égalité vos mots de passe</div>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Inscription</button>
            </form>
        </div>
    </div>
<?php unset($_SESSION['inscription']) ?>
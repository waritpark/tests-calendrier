<?php session_start(); ?>

    <div class="row text-center justify-content-center">
        <div class="col-6">
            <?php if (!empty($_SESSION['changermdp'])) {
                foreach ($_SESSION['changermdp'] as $error) {?>
                <div class="text-danger"><?php echo $error[0]; ?></div>
                <div class="text-success"><?php echo $error[1]; ?></div>
            <?php }
            }; ?>
            <?php if (!empty($_SESSION['connexion'])) {
                foreach ($_SESSION['connexion'] as $error) {?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php }
            }; ?>
            <h2>Connexion</h2>
            <form action="index.php?app=connexionpost" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse mail</label>
                    <input type="mail" class="form-control" id="mail" name="mail">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" autocomplete="off" class="form-control" id="password" name="password">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit"  class="btn btn-primary w-auto">Connexion</button>
                    <a href="recuperation.php" class="w-auto">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </div>


<?php // unset($_SESSION['changermdp']) ?>
<?php // unset($_SESSION['connexion']) ?>
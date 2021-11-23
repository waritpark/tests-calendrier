<?php
session_start();
if($_SESSION['id_utilisateur']=="") {
    header('location:index.php?app=error');
}

require '../../App/bdd.php';
require '../../Public/utility.php';
require '../../Calendar/Event.class.php';
require '../../Calendar/Events.class.php';
require '../../Calendar/Validator-event.class.php';

$pdo = get_pdo();
$events = new Calendrier\Events($pdo);
?>


<?php require '../../Views/includes/header.php'; ?>

<h2>Modifier les informations</h2>
<form action="" method="post" class="mt-4 form-ajout-event">
<?php 
$req1 ='SELECT * FROM t_utilisateur WHERE ID_utilisateur='.$_SESSION['id_utilisateur'].'';
$result=$pdo->query($req1);
while ($row=$result->fetch(PDO::FETCH_ASSOC)){ 
$id = $row['ID_utilisateur'];
?>
    <div class="mb-3">
        <label for="mail" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" id="mail" name="mail" value="<?= $row['mail'] ?>">
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $row['nom'] ?>">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $row['prenom'] ?>">
    </div>
    <div id="pass1">

    </div>

    <div id="pass2">

    </div>
    <?php } ?>
    <div class="d-flex justify-content-between" id="container-btn">
        <div class="btn btn-secondary mb-4 d-none" id="btnCheck" onclick="suppPass()">Annuler</div>
        <div class="btn btn-secondary mb-4" id="btnPass" onclick="afficherPass()">Modifier le mot de passe</div>
        <button type="submit" class="btn btn-primary mb-4">Enregistrer</button>
    </div>
</form>

<?php 
    if(isset($_POST['mail'])
    && isset($_POST['nom'])
    && isset($_POST['prenom'])) {
        $mail=$_POST['mail'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $req2=$pdo->prepare('UPDATE t_utilisateur SET mail=:mail, nom=:nom, prenom=:prenom WHERE ID_utilisateur='.$id.'');
        $req2->execute(array(
            'mail' => $mail,
            'nom' => $nom,
            'prenom' => $prenom
        ));
        header('location:http://localhost/base-learn/Views/calendar/dashboard.php?edit=1');
    }
?>




<?php include('../../Views/includes/footer.php'); ?>
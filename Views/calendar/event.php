<?php 
session_start();
if($_SESSION['mail']=="") {
    header('location:index.php?app=error');
}
?>
<?php require_once '../../Calendar/Events.class.php'; ?>
<?php require_once '../../Public/utility.php'; ?>
<?php require_once '../../App/bdd.php'; ?>
<?php 

$pdo = get_pdo();
$events = new App\Controllers\EventsController($pdo);
try {
    $event = $events->findInUrlId($_GET['id_event']) ?? null;
}
catch (\Exception $e) {
    e404();
}
catch (\Error $e) {
    e404();
}

?>
<?php require_once '../../Views/includes/header.php'; ?>

    <?= var_dump($event);?>



<?php include('../../Views/includes/footer.php'); ?>
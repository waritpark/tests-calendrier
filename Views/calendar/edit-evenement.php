<?php
session_start();
if($_SESSION['mail']=="") {
    header('location:index.php?app=error');
}

require '../../App/bdd.php';
require '../../Public/utility.php';
require '../../App/Models/Event.class.php';
require '../../App/Controllers/Events.class.php';
require '../../App/Controllers/Validator-event.class.php';

$pdo = get_pdo();
$events = new App\Controllers\EventsController($pdo);

try {
    $event = $events->findInUrlId($_GET['id_event'] ?? null);
} 
catch (\Exception $e) {
    e404();
}
catch (\Error $e) {
    e404();
}
?>
<?php 
$errors = [];
$data = [
    'nom' => $event->getName(),
    'desc' => $event->getDesc(),
    'date' => $event->getStart()->format('Y-m-d'),
    'start' => $event->getStart()->format('H:i'),
    'end' => $event->getEnd()->format('H:i')
];

render('../includes/header.php', ['title' => $event->getName()]);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $validator = new App\Controllers\ValidatorEvent($data);
    $errors=$validator->validates($data);
    if (empty($errors)) {
        $event->setName($data['nom']);
        $event->setDesc($data['desc']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date']. ' ' .$data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date']. ' ' . $data['end'])->format('Y-m-d H:i:s'));
        $event->setIdUser($_SESSION['id_utilisateur'],PDO::PARAM_INT);
        debug($event);
        $events->update($event);
        header('Location:../../Views/calendar/dashboard.php?modification=1');
        exit();
    }
}
?>
<?php //require '../Views/includes/header.php'; ?>

<h2>Modifier l'événement : <?php echo h($event->getName()); ?></h2>
<form action="#" method="post" class="mt-4 form-ajout-event">
    <?php render('form-evenement.php', ['data'=>$data, 'errors'=>$errors]); ?>
    <button type="submit" class="btn btn-primary mb-4">Modifier</button>
</form>




<?php include('../../Views/includes/footer.php'); ?>
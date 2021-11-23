<?php
session_start();
if($_SESSION['mail']=="") {
    header('location:index.php?app=error');
}

require '../../App/bdd.php';
require '../../Public/utility.php';
require '../../Calendar/Event.class.php';
require '../../Calendar/Events.class.php';
require '../../Calendar/Validator-event.class.php';

$pdo = get_pdo();
$events = new App\Controllers\EventsController($pdo);

try {
    $event = $events->deleteDate($_GET['id_event'] ?? null);
    header("location:".  $_SERVER['HTTP_REFERER']); 
} 
catch (\Exception $e) {
    e404();
}
catch (\Error $e) {
    e404();
}
?>

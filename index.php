<?php

use App\Controllers\MonthController;
use App\Controllers\EventsController;
use App\Controllers\UtilisateurController;

require './App/autoloader.php'; 

App\Autoloader::register();

if(isset($_GET['app'])) {
    $app = $_GET['app'];
} else {
    $app = 'accueil';
}

ob_start();

if($app === 'accueil') {
    require ''.__DIR__.'\Views\accueil.php';
}
elseif ($app === 'connexion') {
    $connexion = new UtilisateurController();
    $connexion->view_connexion();
}
elseif ($app === 'inscription') {
    $inscription = new UtilisateurController();
    $inscription->view_inscription();
}

elseif ($app === 'connexionpost') {
    $connexion = new UtilisateurController();
    $connexion->easy_login();
}
elseif ($app === 'inscriptionpost') {
    $inscription = new UtilisateurController();
    $inscription->easy_register();
}

elseif ($app === 'dashboard') {
    $dashboard = new MonthController();
    $dashboard->index();
}

elseif ($app === 'new-evenement') {
    require ''.__DIR__.'\Views\calendar\ajout-evenement.php';
}
elseif ($app === 'my-account') {
    require ''.__DIR__.'\Views\users\compte-user.php';
}
elseif ($app === 'deconnexion') {
    $deco = new UtilisateurController();
    $deco->destroy_session();
    require ''.__DIR__.'\Views\accueil.php';
}
elseif ($app === 'statistiques') {
    require ''.__DIR__.'\Views\users\stats.php';
}


else {
    require ''.__DIR__.'\Views\error.php';
}
$content = ob_get_clean();

require './Views/template.php';
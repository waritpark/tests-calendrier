<?php

namespace App\Controllers;

abstract class bdd 
{
    private $bdd;

    // Exécute une requête SQL éventuellement paramétrée
    protected function executerRequete($sql, $params = null) {
    if ($params == null) {
        $resultat = $this->getBdd()->query($sql);    // exécution directe
    }
    else {
        $resultat = $this->getBdd()->prepare($sql);  // requête préparée
        $resultat->execute($params);
    }
    return $resultat;
    }

    // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
    protected function getBdd() {
        if ($this->bdd == null) {
        // Création de la connexion
        $this->bdd = new \PDO('mysql:host=localhost;dbname=bdd_calendrier',
            'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }
}













?>
<?php

namespace App\Models;

class User {
    private $id;
    private $mail;
    private $pseudo;
    private $nom;
    private $prenom;
    private $mdp;

    public function getId(): int {
        return $this->id;
    }
    public function getMail() {
        return $this->mail;
    }
    public function getPseudo(): string {
        return $this->pseudo;
    }
    public function getNom(): string {
        return $this->nom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }
    public function getMdp() {
        return $this->mdp;
    }

    public function setMail(string $mail) {
        $this->mail=$mail;
    }
    public function setPseudo(string $pseudo) {
        $this->pseudo=$pseudo;
    }
    public function setNom(string $nom) {
        $this->nom=$nom;
    }
    public function setPrenom(string $prenom) {
        $this->prenom=$prenom;
    }
    public function setMdp(string $mdp) {
        $this->mdp=$mdp;
    }

}
<?php

// namespace App\Controllers;

// use PDO;

// class BddController 
// {
//     private $db_name;
//     private $db_user;
//     private $db_pass;
//     private $db_host;
//     private $pdo;

//     public function __construct($db_name='bdd_calendrier',$db_user='root', $db_pass='', $db_host='localhost')
//     {
//         $this->db_name=$db_name;
//         $this->db_name=$db_user;
//         $this->db_name=$db_pass;
//         $this->db_name=$db_host;

//     }

//     public function get_pdo() {
//         if($this->pdo === null) {
//             $pdo = new PDO('mysql:host=localhost;dbname=bdd_calendrier', 'root', '');
//             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $this->pdo = $pdo;
//         }
//         return $this->pdo;
//     }

//     public function query($statement){
//         $req = $this->get_pdo()->query($statement);
//         $datas = $req->fetchAll(PDO::FETCH_OBJ);
//         return $datas;
//     }

//     public function prepare($statement, $attributes){
//         $req = $this->get_pdo()->prepare($statement);
//         $req->execute($attributes);
//         $datas = $req->fetchAll(PDO::FETCH_CLASS);
//         return $datas;
//     }


// }
?>
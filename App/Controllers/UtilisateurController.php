<?php

namespace App\Controllers;


use PDO;
use PDOException;
use App\Controllers\bdd;

require './Public/utility.php';

class UtilisateurController extends bdd
{

    public function view_connexion()
    {
        render('.\Views\users\connexion.php');
    }

    public function view_inscription()
    {
        render('./Views/users/inscription.php');
    }

    public function easy_login() 
    {
        if(isset($_POST['mail'])
        && isset($_POST['password'])
        && !empty($_POST['mail'])
        && !empty($_POST['password'])) {
            if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
                $mail = $_POST['mail'];
                $mdp = $_POST['password'];
                $req1= "SELECT * FROM t_utilisateur WHERE mail= :mail";
                $result=$this->getBdd()->prepare($req1);
                $result->bindValue(':mail', $mail);
                $result->execute();
                $resultrow=$result->fetch(PDO::FETCH_ASSOC);
                if (password_verify($mdp, $resultrow['mdp'])) {
                    if($mail!="") {
                        $_SESSION['id_utilisateur']=$resultrow['ID_utilisateur'];
                        $_SESSION['role_user']=$resultrow['role_user'];
                        $_SESSION['mail']=$resultrow['mail'];
                        header('Location:index.php?app=dashboard');
                    }
                    else {
                        header('Location:index.php?app=connexion');
                        session_destroy();
                    }
                }
                else {
                    header('Location:index.php?app=connexion');
        
                }
            }
            else {
                header('Location:index.php?app=connexion');
            }
        }
        else {
            header('Location:index.php?app=connexion');
        }  
    }

    public function easy_mail() 
    {
        $string = implode('', array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9')));
        $token = substr(str_shuffle($string), 0, 20);

        // variables du mail
        $link = "http://localhost/base-learn?token='.$token.'";
        $objet = 'Nouveau mot de passe';
        $to = 'lafarge21@hotmail.fr';
        $headers =["From: Support :<zzzzzzz@zzzz.zz>","MIME-version: 1.0","Content-type: text/html; charset=utf-8","Content-Transfer-Encoding: 8bit"];
        $message = "<html>".
        "<body>".
        "<p>Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe et en recevoir un nouveau.</p>".
        "<a href=".$link." style='font-size: 18px'>Cliquez ici</a>".
        "</body>".
        "</html>";

        //===== Envoi du mail
        $success = mail($to, $objet, $message,implode("\r\n", $headers));
        if (!$success) {
            $errorMessage = error_get_last()['message'];
        }else{
            $_SESSION['mail_change'] = $token;
            array_push($_SESSION['recuperation'],["","Un mail a été envoyé à votre adresse mail."]);
            header("Location:recuperation.php");
        }
    }

    public function valid_donnees($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    public function easy_register()
    {
        new UtilisateurController();
        $mail = $this->valid_donnees($_POST["mail"]);
        $password = $this->valid_donnees($_POST["password"]);

        $pass_hash=password_hash($password, PASSWORD_DEFAULT);

        if (isset($_POST["mail"]) 
            && isset($_POST["password"]) 
            && !empty($_POST["mail"]) 
            && !empty($_POST["password"]) 
            && filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)
            && $_POST["password"]===$_POST["password2"]) {
            $req1 = $this->getBdd()->prepare("SELECT mail FROM t_utilisateur WHERE mail=?");
            $req1->execute([$mail]); 
            $user = $req1->fetch();           
            if ($user) {
                array_push($_SESSION['inscription'],"Ce mail est deja pris !");
                header("Location:index.php?app=error");
            }
            else {
                try {
                    $req = $this->getBdd()->prepare("INSERT INTO t_utilisateur (mail, mdp, role_user) VALUES (:mail, :mdp, 2)");
                    $req->execute(array(
                        "mail" => $mail,
                        "mdp" => $pass_hash
                        ));
                    $req->fetch(PDO::FETCH_ASSOC);
                    header('Location:index.php?app=connexion');
                }
                catch(PDOException $e) {
                    echo 'Erreur : '.$e->getMessage();
                }
            }
        }
        else {
            array_push($_SESSION['inscription'],"Erreur dans la grosse condition.");
            header("Location:index.php?app=inscription");
        }
    }

    public function password_change()
    {
        if(isset($_POST['token'])
        && isset($_POST['mail'])  
        && isset($_POST['new_password']) 
        && isset($_POST['repeat_password']) 
        && !empty($_POST['token'])
        && !empty($_POST['mail'])  
        && !empty($_POST['new_password']) 
        && !empty($_POST['repeat_password']) 
        && $_POST['new_password']===$_POST['repeat_password']){
            $mail=$_POST['mail']; 
            $token=$_POST['token'];
            $verif_token=$this->getBdd()->prepare("SELECT * FROM t_recuperation WHERE token_recup=?");
            $verif_token->execute([$token]);
            $resultrow=$verif_token->fetch(PDO::FETCH_ASSOC);
            if ($resultrow) {
                $newMdp=password_hash($_POST["new_password"], PASSWORD_DEFAULT);
                $req2=$this->getBdd()->prepare("UPDATE t_utilisateur SET mdp =? WHERE mail=$mail");
                $req2->execute([$newMdp]);

                array_push($_SESSION['changermdp'],["", "Vous avez changé de mot de passe !"]);
                header("Location:../Forms/connexion.php");
            } else {
                array_push($_SESSION['changermdp'],["Mauvais token !", ""]);
                header("Location:../Forms/connexion.php");

            }
        }
        else {
            array_push($_SESSION['changermdp'],["Erreur.", ""]);
            header("Refresh: 2");
        }
    }

    public static function destroy_session()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location:http://localhost/base-learn/");
        exit();
    }





}
?>
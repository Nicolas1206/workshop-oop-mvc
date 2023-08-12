<?php

namespace controllers;

use Exception;
use models\User;

class AuthController extends User 
{
    /**
     * @return void
     */
    public function showLoginForm(): void
    {
        if (!empty($_GET['error_value'])){
        $error_value = $_GET['error_value'];
    }
        include_once "views/layout/header.view.php";
        include_once "views/login.view.php";
        include_once "views/layout/footer.view.php";
    }
    public function registerVerification(array $post): void
    {
        try{
            // check l'inscription d'un utilisateur
            // check si les champs ne sont pas vide
            // 101 => si les champs son vide
            // 102 => si l'utilisateur existe dans la DB
            // 201 => si l'email n'est aps valide
            // 500 => erreur serveur
            if (empty($post['username']) || empty($post['email']) || empty($post['password'])){
                throw new Exception("101");
            }

            $username = htmlspecialchars($post['username']);

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("202");
            }

            $user = User::getUserByUsernameAndEmail(
                [
                    "username" => $username,
                    "email" => $email
                ]
            );
            if (!empty($user)){
                throw new Exception("102");
            }

            $resultArray = User::insertNewUser(
                [
                    "username" => $username,
                    "email" => $email,
                    "password" => password_hash($post['password'], PASSWORD_DEFAULT)
                ]
                );
            if (!$resultArray["bool"]) {
                throw new Exception("500");
            }
            unset($_SESSION['classicmodels_user']);

            $_SESSION['classicmodels_user'] = array
            (
                "id" => $resultArray['id'],
                "username" => $username,
                "email" => $email
            );
            header('Location: /');
        }catch (Exception $e){
            $location = 'Location: /register?error_value=';
            $msg = $e->getMessage();
    
            switch ($msg) {
                case "101":
                    $location .= 'nodata';
                    break;
                case "102":
                    $location .= "exist";
                    break;
                case "201":
                    $location .= "email";
                    break;
                case "500":
                    $location .= "server";
                    break;
                default:
                    header('Location: /error');
                 }
                 // $location => 'Location: /register?error_value={:nodata | :nodb | :email | :pwd}
                 header($location);
        }

    }
    public function showRegisterForm()
    {
        if (!empty($_GET['error_value'])){
            $error_value = $_GET['error_value'];
        }
            include_once "views/layout/header.view.php";
            include_once "views/register.view.php";
            include_once "views/layout/footer.view.php";
    }
    public function logout(): void
    {
        unset($_SESSION['classicmodels_user']);
        header('Location: /');
    }
    public function loginVerification(array $post): void
    {
        try{
        // check la connexion d'un utilisateur
        // check si les champs ne sont pas vide
        // 101 => si les champs son vide
        // 102 => si l'utilisateur n'existe pas dans la DB
        // 201 => si l'email n'est aps valide
        // 202 => si le mot de passe n'est pas valide

        if(empty($_POST['email']) || empty($post['password'])){
            throw new Exception("101");
        }
        //on filtre l'email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('201');
        }
        // on cherche l'user associé à l'email
        $user = User::getUserByEmail($email);
        if (empty($user)){
            throw new Exception("102");
        }

        if (!password_verify($post['password'], $user['password'])) {
            throw new exception("202");
        }
        unset($_SESSION['classicmodels_user']);
        $_SESSION['classicmodels_user'] = array(
            "id" => $user['id'],
            "username" => $user['username'],
            "email" => $email
        );

        header('Location: /');
    }catch (Exception $e){
        $location = 'Location: /login?error_value=';
        $msg = $e->getMessage();

        switch ($msg){
            case "101":
                $location .= 'nodata';
                break;
            case "102":
                $location .= "nodb";
                break;
            case "201":
                $location .= "email";
                break;
            case "202":
                $location .= "pwd";
                break;
            default:
                header('Location: /error');
             }
             // $location => 'Location: /login?error_value={:nodata | :nodb | :email | :pwd}
             header($location);
        }
    }
}
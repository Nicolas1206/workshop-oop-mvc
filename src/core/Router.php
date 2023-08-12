<?php
namespace core;

use controllers\ProductController;
use controllers\AuthController;

class Router
{
    public function route(string $uri_path): void
    {
        switch ($uri_path) {
            // page d'accueil
            case "/":
            case "/index":
            case "/home":
                $productController = new ProductController();
                $productController->showHome();
                break;
            case "/product":
                    $productController = new ProductController();
                    $productController->showProductInfo(htmlspecialchars($_GET['productCode']));
                    break;
                case "/login":
                    $authController = new AuthController();
                    if (empty($_POST)){
                        $authController->showLoginForm();
                    }else {
                        $authController->loginVerification($_POST);
                    }
                    break;
                    case "/register":
                        $authController = new AuthController();
                        if (empty($_POST)){
                            $authController->showRegisterForm();
                        }else {
                            $authController->registerVerification($_POST);
                        }
                        break;
                case "/register":
                    echo "";
                    break;
                case "/logout":
                    $authController = new AuthController();
                    $authController->logout();
                    break;
        }
    }
}
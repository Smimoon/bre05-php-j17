<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

session_start();

require "config/autoload.php";

if (empty($_SESSION['csrf_token']))
{
    $tokenManager = new CSRFTokenManager();
    $_SESSION['csrf_token'] = $tokenManager->generateCSRFToken();
}

$router = new Router();

$router->handleRequest($_GET);
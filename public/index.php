<?php

header("content-Type: application/json");

require_once "../src/Core/Router.php";

$router = new Router();
$router->handleRequest();
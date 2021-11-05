<?php

use Views\View;

$movietable = new View("moviestable");
$movietable->movies = $movies;
$movietable->inputs = $inputs;
$movietable->headers = $headers;
$movietable->params = $params;

$ticketform = new View("form");
$ticketform->innerview = $movietable->render();
$ticketform->method = $method;
$ticketform->action = $action;
echo $ticketform->render();
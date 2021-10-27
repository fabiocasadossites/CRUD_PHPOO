<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
// CHAMANDO O AUTOLOAD
require __DIR__ . '/../vendor/autoload.php';

//CHAMANDO AS VARIÁVEIS DE AMBIENTE
\App\Helpers\Environment::load(__DIR__ . './../app/');

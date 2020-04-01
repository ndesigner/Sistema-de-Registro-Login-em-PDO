<?php

    date_default_timezone_set("America/Sao_Paulo");
    
    $dataGeral = new DateTime;
    
    $ipUsuario = $_SERVER['REMOTE_ADDR'];

    /* Array de configuração do sistema */

    CONST HOSTNAME = 'localhost';
    CONST USERNAME = 'root';
    CONST PASSWORD = '';
    CONST DATABASE = 'npanel';

    $config = array(
        'HOSTNAME' => HOSTNAME,
        'USERNAME' => USERNAME,
        'PASSWORD' => PASSWORD,
        'DATABASE' => DATABASE
    );

    try {
        $pdo = new PDO("mysql:host=".$config['HOSTNAME'].";dbname=".$config['DATABASE'], $config['USERNAME'], $config['PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Erro ao conectar com o banco de dados.'. $e->getMessage();
    }

<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 04/11/2019
 */

require_once 'model/database.php';

$controller = 'trend';

// Toda esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    //Primero cargamos el feed y lo guardamos en la BBDD para posteriormente mostrarlo en la tabla

    $periodicos = [
        [
            'url'=>"https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml",
            'nombre'=>'El Mundo'
        ],
        [
            'url'=>"https://elpais.com/rss/elpais/portada.xml",
            'nombre'=>'El País'
        ]
    ];

    $controller->get_feed($periodicos);

    $controller->Index();
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

    // Instanciamos el controlador
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}
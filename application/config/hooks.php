<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller_constructor'] = [
    
    # si el usuario esta logado en la aplicacion, lo busca en la base de datos y lo inicializa
//    [
//        'class'    => 'PostControllerConstructorHook',
//        'function' => 'inicializeUser',
//        'filename' => 'PostControllerConstructorHook.php',
//        'filepath' => 'hooks',
//    ],
    
    # comprueba si el usuario tiene permisos para acceder, sino saca un error 503 Forbbiden
//    [
//        'class'    => 'PostControllerConstructorHook',
//        'function' => 'checkSecurity',
//        'filename' => 'PostControllerConstructorHook.php',
//        'filepath' => 'hooks',
//    ],
    
    # comprueba si el usuario tiene permisos para acceder, sino saca un error 503 Forbbiden
//    [
//        'class'    => 'PostControllerConstructorHook',
//        'function' => 'loadStructureData',
//        'filename' => 'PostControllerConstructorHook.php',
//        'filepath' => 'hooks',
//    ],

];

<?php

/**
 * Account groups:
 * -1 => obligatorio estar deslogado
 * 0 => uso publico
 * 1 => normal user
 * 2 => blogger
 * 3 => gestor?
 * 5 => analista
 * 
 * 14 => admin
 */
$security = [
    '/^panel.*/' => [1,14],
    '/^blogger.*/' => [2,14],
    '/^ana.*/' => [3,14],
    '/^adm.*/' => [14],
];
$config["security"] = $security;
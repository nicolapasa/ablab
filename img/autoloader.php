<?php
/*
 * tutte le classi vanno incluse in questo file
 * 
 */

spl_autoload_register(function ($class) {
    include 'class/class.' . $class . '.php';
});
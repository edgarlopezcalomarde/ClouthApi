<?php

define("BASE_DIR", dirname(__DIR__));
 
if (! function_exists('base_path')) {
    function base_path(string $path = ''): string {
        return BASE_DIR . "/" . ltrim($path, "/"); //Devuelve desde v1/
    }
}



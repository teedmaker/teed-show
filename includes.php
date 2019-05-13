<?php

spl_autoload_register(function(string $class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = "src/{$class}.php";
    if(file_exists($class)) {
        include $class;
    }
});

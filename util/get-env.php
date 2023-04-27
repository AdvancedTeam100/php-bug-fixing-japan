<?php

    $env = file(__DIR__.'./.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($env as &$line) {
        $key = trim(explode("=", $line)[0]);
        $val = trim(explode("=", $line)[1]);
        $line = [
            $key => $val
        ];
    }
    unset($line);
    $env = array_reduce($env, 'array_merge', array());

?>
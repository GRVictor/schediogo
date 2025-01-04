<?php

function debug($var) : string {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function itIsLast($currentKey, $next) : bool {
    if($currentKey !== $next) {
        return true;
    }
    return false;
}

// Check if the user is authenticated
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}
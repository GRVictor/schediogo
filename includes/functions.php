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
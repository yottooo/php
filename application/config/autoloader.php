<?php
function __autoload($className) {
    $classNameReplace = str_replace('\\','/', $className);
    $filename = $classNameReplace . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}
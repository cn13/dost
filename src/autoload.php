<?php

/**
 * Автозагрузка классов
 */
spl_autoload_register(
    static function ($name) {
        $fileClass = __DIR__ . DIRECTORY_SEPARATOR . $name . '.php';
        if (file_exists($fileClass)) {
            require_once $fileClass;
        } else {
            throw new Exception("Невозможно загрузить класс $name.");
        }
    }
);
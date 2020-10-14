<?php

/**
 * Автопозгрузка классов
 */
require 'autoload.php';

$text = $_GET['text'] ?? 'Привет привет ПРИВЕТ, ПрИвет. Privet/privet Test TEST tEsT?TESt test test test';

//для красивого print_r
echo '<pre>';

try {
    $app = new \classes\TextWordWrapper($text);
    $app->setResultSlice(5);

    #регистроНЕзависимый поиск
    $app->setCaseSensitive(true);
    $app->process();
    echo 'setCaseSensitive = true' . PHP_EOL;
    print_r($app->result);

    #регистрозависимый поиск
    $app->setCaseSensitive(false);
    $app->setText($text);
    $app->process();
    echo '<hr>setCaseSensitive = false' . PHP_EOL;
    print_r($app->result);
} catch (Throwable $e) {
    throw $e;
}
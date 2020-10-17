<?php

declare(strict_types=1);

/**
 * Автопозгрузка классов
 */
require 'autoload.php';

$text = 'Привет привет ПРИВЕТ, ПрИвет. Privet/privet Test TEST tEsT?TESt test test test';

//для красивого print_r
echo '<pre>';
try {
    /**
     * TextWordWrapper
     */
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

    /**
     * ChessCheck
     */
    echo '<hr>Check Color CELS: A1 and B2 ' . PHP_EOL;
    $chess = new \classes\ChessCheck('a1', 'b2');
    $chess->process();

    /**
     * BracketString
     */
    $bStr = ['([{}])()(){}[{}]', '([)][]'];
    foreach ($bStr as $bString) {
        echo '<hr>Validate: ' . $bString . PHP_EOL;
        var_dump(\classes\BracketString::isValidateString($bString));
    }
} catch (Throwable $e) {
    throw $e;
}
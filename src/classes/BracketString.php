<?php

namespace classes;

/**
 * Class BracketString
 *
 * @package classes
 */
class BracketString
{
    /**
     * Сопоставление левого и правого символа
     */
    public CONST MAP = ['[' => ']', '{' => '}', '(' => ')'];

    /**
     * Валидация строки
     *
     * @param string $string
     * @return bool
     * @throws \Exception
     */
    public static function isValidateString(string $string): bool
    {
        #Пилим строку в массив
        $arrayBracket = str_split($string);
        while ($item = array_shift($arrayBracket)) {
            #Если правая скобка
            if (in_array($item, array_keys(self::MAP))) {
                #Дополняем стэк
                $leftBracket[] = $item;
            } #Если правая скобка
            elseif (in_array($item, array_values(self::MAP))) {
                #Бежим по стэку левых скобок
                while ($leftB = array_pop($leftBracket)) {
                    $rightB = $item ?? array_shift($arrayBracket);
                    #Если левая скобка из стэка не соответствует маппингу правой, то строка не валидна
                    if (self::MAP[$leftB] !== $rightB) {
                        return false;
                    }
                    $item = null;
                }
            } #Если совсем не скобка
            else {
                throw new \Exception('Bad string!!!');
            }
        }
        return true;
    }
}
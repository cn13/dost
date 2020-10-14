<?php

namespace classes;

/**
 * Class TextWordWrapper
 *
 * @package classes
 * @property $text            string
 * @property $caseSensitive   bool
 * @property $resultSlice     int
 * @property $words           array
 * @property $result          array
 */
class TextWordWrapper
{
    /**
     * @var array
     */
    public array $result = [];

    /**
     * Текст для обработки
     *
     * @var string
     */
    private string $text;

    /**
     * @var array
     */
    private array $words = [];

    /**
     * Регистрозависимость
     *
     * @var bool
     */
    private bool $caseSensitive = true;

    /**
     * @var int
     */
    private int $resultSlice = 5;

    /**
     * TextWordWrapper constructor.
     *
     * @param $text
     * @throws \Exception
     */
    public function __construct($text)
    {
        if (empty($text)) {
            throw new \Exception('Текст для обработки не может быть пустым');
        }
        $this->setText($text);
    }

    /**
     * @param bool $value
     */
    public function setCaseSensitive(bool $value): void
    {
        $this->caseSensitive = $value;
    }

    /**
     * @param int $value
     */
    public function setResultSlice(int $value): void
    {
        $this->resultSlice = $value;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
        $this->words = [];
        $this->result = [];
    }

    /**
     * Заполним слова из текста
     *
     * @throws \Exception
     */
    private function getWords(): void
    {
        if (preg_match_all("/\b(\w+)\b/u", $this->text, $matches)) {
            $this->words = $matches[1] ?? [];
            sort($this->words);
        } else {
            throw new \Exception('Слов в тексе маловато');
        }
    }

    /**
     * Приводим слова к нужному регистру, считает сколько раз оно попадалось в тексте
     */
    private function prepareResult(): void
    {
        /**
         * Перебор всех слов из текста
         */
        while ($word = array_shift($this->words)) {
            $this->addWordToResult($word);
        }
        arsort($this->result);

        /**
         * Отрезаем результат до нужной нам длины, после сортировки
         */
        $this->result = array_slice($this->result, 0, $this->resultSlice ?? 5);
    }

    /**
     * @param $word
     */
    private function addWordToResult($word)
    {
        /**
         * Подбираем ключик, смотря на регистр
         */
        if ($this->caseSensitive === true) {
            $word = mb_strtolower($word);
        }

        if (isset($this->result[$word])) {
            ++$this->result[$word];
        } else {
            $this->result[$word] = 1;
        }
    }

    /**
     * Запуск обработки текста
     *
     * @throws \Exception
     */
    public function process(): void
    {
        $this->getWords();
        $this->prepareResult();
    }
}
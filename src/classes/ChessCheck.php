<?php

namespace classes;

/**
 * Class ChessCheck
 *
 * @package classes
 * @property $cols       array
 * @property $rows       array
 * @property $cellOne    string
 * @property $cellSecond string
 */
class ChessCheck
{
    private array $cols;
    private array $rows;
    private string $cellOne;
    private string $cellSecond;

    public function __construct(string $one, string $two)
    {
        $this->cols = range('A', 'H');
        $this->rows = range(1, 8);
        $this->cellOne = $one;
        $this->cellSecond = $two;
    }

    /**
     * @param string $coordinate
     * @return bool
     * @throws \Exception
     */
    private function isBlack(string $coordinate): bool
    {
        $c = $this->prepareCoordinate($coordinate);
        $colIndex = array_search($c[0], $this->cols) % 2;
        $rowIndex = array_search($c[1], $this->rows) % 2;
        if ($colIndex === 0) {
            return $rowIndex === 0;
        } else {
            return $rowIndex !== 0;
        }
    }

    /**
     * @param string $coordinate
     * @return array
     * @throws \Exception
     */
    private function prepareCoordinate(string $coordinate): array
    {
        if (mb_strlen($coordinate) !== 2) {
            throw new \Exception('Координаты не верны');
        }
        $coordinate = str_split($coordinate);
        $coordinate[0] = mb_strtoupper($coordinate[0]);

        if (!in_array($coordinate[0], $this->cols)) {
            throw new \Exception('За пределами колонок');
        }

        if (!in_array($coordinate[1], $this->rows)) {
            throw new \Exception('За пределами строк');
        }

        return $coordinate;
    }

    /**
     * Запуск программы
     *
     * @throws \Exception
     */
    public function process()
    {
        if ($this->isBlack($this->cellOne) === $this->isBlack($this->cellSecond)) {
            echo 'Одного цвета';
        } else {
            echo 'Разного цвета';
        }
    }
}
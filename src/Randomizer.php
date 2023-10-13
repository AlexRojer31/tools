<?php
namespace Tools;

/**
 * Генератор рандомных значений
 * и хэшей
 */
class Randomizer
{

    /**
     * Генерирует псевдослучайную строку из символов
     * указанной длины
     *
     * @param integer $length
     * @return string
     */
    public static function getString(int $length): string
    {
        if ($length <= 0) {
            return '';
        }
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            if (rand(0, 1) > 0) {
                $ch = chr(rand(65, 90));
            } else {
                $ch = chr(rand(97, 122));
            }
            $string .= $ch;
        }

        return $string;
    }

    /**
     * Генерирует псевдослучайное число
     * указанной длины
     *
     * @param integer $length
     *
     * @return int
     */
    public static function getNumber(int $length): int
    {
        if ($length > 1) {
            $min = pow(10, $length - 1);
            $max = pow(10, $length) - 1;

            return intval(rand($min, $max));
        } elseif ($length == 1) {
            $string = '';
            for ($i = 0; $i < $length; $i++) {
                $string .= rand(0, 9);
            }

            return intval($string);
        } else {
            return 0;
        }
    }

    /**
     * Генерирует псевдослучайное строку
     * из чисел и символов
     *
     * @param integer $length
     *
     * @return string
     */
    public static function getStringAndNumber(int $length): string
    {
        if ($length <= 0) {
            return '';
        }
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            if (rand(0, 1) > 0) {
                $string .= static::getString(1);
            } else {
                $string .= static::getNumber(1);
            }
        }

        return $string;
    }

    /**
     * Возвращает хэшированную строку
     *
     * @param string $str
     *
     * @return string
     */
    public static function getHash(string $str): string
    {
        return md5($str);
    }

}

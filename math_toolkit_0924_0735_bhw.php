<?php
// 代码生成时间: 2025-09-24 07:35:08
class MathToolkit extends \yii\base\Model
{
    private $errors = [];

    /**
     * Adds two numbers together.
     *
     * @param float $num1
     * @param float $num2
     * @return float
     */
    public function add($num1, $num2)
    {
        if (!is_numeric($num1) || !is_numeric($num2)) {
            $this->errors[] = 'Both arguments must be numbers.';
            return null;
        }

        return $num1 + $num2;
    }

    /**
     * Subtracts one number from another.
     *
     * @param float $num1
     * @param float $num2
     * @return float
     */
    public function subtract($num1, $num2)
    {
        if (!is_numeric($num1) || !is_numeric($num2)) {
            $this->errors[] = 'Both arguments must be numbers.';
            return null;
        }

        return $num1 - $num2;
    }

    /**
     * Multiplies two numbers.
     *
     * @param float $num1
     * @param float $num2
     * @return float
     */
    public function multiply($num1, $num2)
    {
        if (!is_numeric($num1) || !is_numeric($num2)) {
            $this->errors[] = 'Both arguments must be numbers.';
            return null;
        }

        return $num1 * $num2;
    }

    /**
     * Divides one number by another.
     *
     * @param float $num1
     * @param float $num2
     * @return float|null
     */
    public function divide($num1, $num2)
    {
        if (!is_numeric($num1) || !is_numeric($num2) || $num2 == 0) {
            $this->errors[] = 'Both arguments must be numbers, and divisor cannot be zero.';
            return null;
        }

        return $num1 / $num2;
    }

    /**
     * Gets any errors that have occurred during operations.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}

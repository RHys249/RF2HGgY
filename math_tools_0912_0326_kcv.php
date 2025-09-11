<?php
// 代码生成时间: 2025-09-12 03:26:59
 * This class is designed to be easily extendable and maintainable,
 * following best practices for PHP and Yii framework.
 */
class MathTools {

    /**
     * Adds two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * Subtracts one number from another.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * Multiplies two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * Divides one number by another.
     *
     * @param float $a
     * @param float $b
     * @return float|null
     */
    public function divide($a, $b) {
        if ($b == 0) {
            throw new InvalidArgumentException('Cannot divide by zero.');
        }
        return $a / $b;
    }

    /**
     * Calculates the power of a number.
     *
     * @param float $base The base number.
     * @param float $exponent The exponent to which the base is raised.
     * @return float
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    /**
     * Calculates the square root of a number.
     *
     * @param float $number The number to calculate the square root for.
     * @return float
     */
    public function squareRoot($number) {
        if ($number < 0) {
            throw new InvalidArgumentException('Cannot calculate square root of a negative number.');
        }
        return sqrt($number);
    }
}

// Example usage:
try {
    $mathTools = new MathTools();
    echo $mathTools->add(5, 3) . "
";
    echo $mathTools->subtract(10, 4) . "
";
    echo $mathTools->multiply(6, 7) . "
";
    echo $mathTools->divide(8, 2) . "
";
    echo $mathTools->power(2, 3) . "
";
    echo $mathTools->squareRoot(16) . "
";
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage();
}

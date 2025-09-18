<?php
// 代码生成时间: 2025-09-19 01:06:56
// MathToolkit.php

class MathToolkit {
    // 常量定义错误代码
    const ERROR_INVALID_ARGUMENT = 1;
    const ERROR_MATH_OPERATION_FAILED = 2;

    // 计算两个数的和
    public function add($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Invalid argument provided for addition.', self::ERROR_INVALID_ARGUMENT);
        }
        return $a + $b;
    }

    // 计算两个数的差
    public function subtract($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Invalid argument provided for subtraction.', self::ERROR_INVALID_ARGUMENT);
        }
        return $a - $b;
    }

    // 计算两个数的乘积
    public function multiply($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Invalid argument provided for multiplication.', self::ERROR_INVALID_ARGUMENT);
        }
        return $a * $b;
    }

    // 计算两个数的商
    public function divide($a, $b) {
        if (!is_numeric($a) || !is_numeric($b) || $b == 0) {
            throw new InvalidArgumentException('Invalid argument provided for division or division by zero.', self::ERROR_INVALID_ARGUMENT);
        }
        return $a / $b;
    }

    // 计算一个数的平方根
    public function squareRoot($a) {
        if (!is_numeric($a) || $a < 0) {
            throw new InvalidArgumentException('Invalid argument provided for square root calculation.', self::ERROR_INVALID_ARGUMENT);
        }
        return sqrt($a);
    }

    // 获取数学运算错误信息
    public function getErrorMessage($errorCode) {
        switch ($errorCode) {
            case self::ERROR_INVALID_ARGUMENT:
                return 'Invalid argument provided for math operation.';
            case self::ERROR_MATH_OPERATION_FAILED:
                return 'Math operation failed.';
            default:
                return 'Unknown error.';
        }
    }
}

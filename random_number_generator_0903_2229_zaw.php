<?php
// 代码生成时间: 2025-09-03 22:29:51
class RandomNumberGenerator extends \yii\base\Component
{
    private $min;
    private $max;

    /**
     * Constructor
     *
     * @param int $min Minimum value of the random number
     * @param int $max Maximum value of the random number
     */
    public function __construct($min = 0, $max = 100)
    {
        parent::__construct();

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Generates a random number between the minimum and maximum values.
     *
     * @return int Random number
     */
    public function generate()
    {
        if ($this->min > $this->max) {
            throw new \yii\base\InvalidParamException('Minimum value cannot be greater than maximum value.');
        }

        return \rand($this->min, $this->max);
    }
}

// Example usage
try {
    $generator = new RandomNumberGenerator(10, 50);
    $randomNumber = $generator->generate();
    echo "Generated random number: $randomNumber";
} catch (\yii\base\InvalidParamException $e) {
    echo "Error: " . $e->getMessage();
}

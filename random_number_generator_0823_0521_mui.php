<?php
// 代码生成时间: 2025-08-23 05:21:32
class RandomNumberGenerator {

    /**
     * Generates a random number within the specified range.
     *
     * @param int $min Minimum value in the range.
     * @param int $max Maximum value in the range.
     *
     * @return int Random number within the specified range.
     *
     * @throws InvalidArgumentException If the range is invalid.
     */
    public function generateRandomNumber($min, $max) {
        // Check if the range is valid
        if ($min > $max) {
            throw new InvalidArgumentException("Minimum value cannot be greater than maximum value.");
        }

        // Generate a random number within the range using mt_rand function
        return mt_rand($min, $max);
    }
}

// Example usage
try {
    $generator = new RandomNumberGenerator();
    $randomNumber = $generator->generateRandomNumber(1, 100);
    echo "Generated random number: $randomNumber";
} catch (InvalidArgumentException $e) {
    // Handle the error if the range is invalid
    echo "Error: " . $e->getMessage();
}

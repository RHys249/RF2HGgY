<?php
// 代码生成时间: 2025-10-08 21:01:54
 * This class provides functionality to calculate hash values for input strings.
 * It supports various hash algorithms.
 *
 * @author Your Name
 * @version 1.0
 */
class HashValueCalculator {

    /**
     * Calculate hash value using specified algorithm.
     *
     * @param string $input The input string to be hashed.
     * @param string $algorithm The hash algorithm to use (e.g., 'md5', 'sha256').
     * @return string The calculated hash value.
     * @throws InvalidArgumentException If the algorithm is not supported.
     */
    public function calculateHash($input, $algorithm = 'md5') {
        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new InvalidArgumentException("Unsupported hash algorithm: {$algorithm}.");
        }

        // Calculate and return the hash
        return hash($algorithm, $input);
    }
}

// Example usage:
try {
    $hashCalculator = new HashValueCalculator();
    $inputString = "Hello, World!";
    $algorithm = "sha256";
    $hash = $hashCalculator->calculateHash($inputString, $algorithm);
    echo "Input: {$inputString}
";
    echo "Hash ({$algorithm}): {$hash}
";
} catch (InvalidArgumentException $e) {
    // Handle the error
    echo "Error: " . $e->getMessage();
}

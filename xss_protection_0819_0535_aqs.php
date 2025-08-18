<?php
// 代码生成时间: 2025-08-19 05:35:16
class XssProtection {

    /**
     * Sanitizes input to prevent XSS attacks.
     *
     * @param string $input The input string to sanitize.
     * @return string Sanitized input.
     */
    public function sanitizeInput($input) {
        if (empty($input)) {
            return '';
        }

        // Use htmlspecialchars to convert special characters to HTML entities
        $sanitizedInput = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        return $sanitizedInput;
    }

    /**
     * Encodes output to prevent XSS attacks.
     *
     * @param string $output The output string to encode.
     * @return string Encoded output.
     */
    public function encodeOutput($output) {
        if (empty($output)) {
            return '';
        }

        // Use htmlspecialchars to encode output
        $encodedOutput = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');

        return $encodedOutput;
    }
}

// Example usage of XssProtection class
try {
    $xssProtection = new XssProtection();

    // Sanitize user input
    $userInput = '<script>alert("XSS")</script>';
    $sanitizedInput = $xssProtection->sanitizeInput($userInput);
    echo "Sanitized Input: " . $sanitizedInput;

    // Encode output
    $output = '<script>alert("XSS")</script>';
    $encodedOutput = $xssProtection->encodeOutput($output);
    echo "
Encoded Output: " . $encodedOutput;

} catch (Exception $e) {
    // Error handling
    echo "Error: " . $e->getMessage();
}

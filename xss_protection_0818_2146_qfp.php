<?php
// 代码生成时间: 2025-08-18 21:46:48
class XssProtection
{
    /**
     * Sanitizes user input to prevent XSS attacks.
     *
     * @param string $input The input to be sanitized.
     * @return string The sanitized input.
     */
    public static function sanitizeInput($input)
    {
        // Use strip_tags to remove HTML tags
        $sanitizedInput = strip_tags($input);

        // Use htmlspecialchars to convert special characters to HTML entities
        $sanitizedInput = htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8');

        return $sanitizedInput;
    }
}


// Example usage
try {
    $unsafeInput = $_GET['user_input'] ?? '';
    $safeInput = XssProtection::sanitizeInput($unsafeInput);
    echo 'Safe input: ' . $safeInput;
} catch (Exception $e) {
    // Handle any exceptions that occur during sanitization
    echo 'Error: ' . $e->getMessage();
}

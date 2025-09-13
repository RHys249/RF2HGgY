<?php
// 代码生成时间: 2025-09-14 03:34:50
class ApiResponseFormatter {

    // Constants for different response types
    const SUCCESS = 1;
    const ERROR = 0;

    // Format a success response
    public static function formatSuccess($data = [], $message = 'Success', $code = 200) {
        // Return a standardized success response
        return [
            'status' => self::SUCCESS,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }

    // Format an error response
    public static function formatError($message = 'Error', $code = 500, $data = []) {
        // Return a standardized error response
        return [
            'status' => self::ERROR,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }
}

/**
 * Example usage of ApiResponseFormatter
 */
try {
    // Simulate a successful API call
    $response = ApiResponseFormatter::formatSuccess(['user' => 'John Doe'], 'User data retrieved successfully');
    echo json_encode($response);

    // Simulate an error API call
    // $response = ApiResponseFormatter::formatError('User not found', 404);
    // echo json_encode($response);
} catch (Exception $e) {
    // Handle any exceptions that may occur
    $response = ApiResponseFormatter::formatError($e->getMessage(), 500);
    echo json_encode($response);
}

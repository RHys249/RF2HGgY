<?php
// 代码生成时间: 2025-08-24 12:10:44
class ApiResponseFormatter
{

    private $status;
    private $message;
    private $data;
    private $errors;

    /**
     * Constructor for ApiResponseFormatter
     *
     * @param int $status The HTTP status code
     * @param string $message A message to include in the response
     * @param array $data The data payload
     * @param array $errors Optional error details
     */
    public function __construct($status, $message, $data = [], $errors = [])
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;
    }

    /**
     * Formats the response into a JSON string
     *
     * @return string The formatted JSON response
     */
    public function formatResponse()
    {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        return json_encode($response);
    }

}

/**
 * Usage example
 */
try {
    // Create a new ApiResponseFormatter instance
    $responseFormatter = new ApiResponseFormatter(200, 'Success', ['key' => 'value']);

    // Format the response
    $formattedResponse = $responseFormatter->formatResponse();

    // Output the response (e.g., for API usage)
    header('Content-Type: application/json');
    echo $formattedResponse;
} catch (Exception $e) {
    // Handle any exceptions that may occur
    $responseFormatter = new ApiResponseFormatter(500, 'Internal Server Error', [], ['error' => $e->getMessage()]);
    header('Content-Type: application/json');
    echo $responseFormatter->formatResponse();
}

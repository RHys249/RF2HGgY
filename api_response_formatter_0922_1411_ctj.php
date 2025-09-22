<?php
// 代码生成时间: 2025-09-22 14:11:59
class ApiResponseFormatter
{
    private $data;
    private $message;
    private $code;
    private $errors = [];

    public function __construct($data = null, $message = '', $code = 200)
    {
        $this->data = $data;
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * Set data for the API response
     *
     * @param mixed $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set message for the API response
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Set code for the API response
     *
     * @param int $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Add error to the API response
     *
     * @param string $error
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Get the formatted API response
     *
     * @return array
     */
    public function getResponse()
    {
        $response = [
            'data' => $this->data,
            'message' => $this->message,
            'code' => $this->code,
            'errors' => $this->errors
        ];

        return $response;
    }

    /**
     * Return the API response in JSON format
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->getResponse());
    }
}

// Usage example:
// $formatter = new ApiResponseFormatter();
// $formatter->setData(['id' => 123, 'name' => 'John'])->setMessage('User fetched successfully.')->setCode(200);
// echo $formatter->toJson();

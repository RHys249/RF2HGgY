<?php
// 代码生成时间: 2025-08-23 21:02:43
// Required Yii2 autoloader
require_once 'vendor/autoload.php';

use yiiase\Model;
use yii\validators\RequiredValidator;
use yii\validators\EmailValidator;
use yii\validators\StringValidator;

class FormValidator extends Model
{
    // Declare attributes that will be validated
    public $username;
    public $email;
    public $message;

    /*
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Username must be filled out and at least 3 characters long
            [['username'], RequiredValidator::class, 'message' => 'Username cannot be blank.'],
            [['username'], StringValidator::class, 'min' => 3, 'tooShort' => 'Username must be at least 3 characters long.'],

            // Email must be filled out and a valid email address
            [['email'], RequiredValidator::class, 'message' => 'Email cannot be blank.'],
            [['email'], EmailValidator::class, 'message' => 'Email is not a valid email address.'],

            // Message must be filled out and at least 10 characters long
            [['message'], RequiredValidator::class, 'message' => 'Message cannot be blank.'],
            [['message'], StringValidator::class, 'min' => 10, 'tooShort' => 'Message must be at least 10 characters long.'],
        ];
    }

    /*
     * Validate the form data and return the result
     *
     * @param array $data Form data to validate
     * @return bool Whether the data is valid or not
     */
    public function validateData($data)
    {
        $this->attributes = $data;

        // Validate the model data
        if ($this->validate()) {
            // Data is valid
            return true;
        } else {
            // Data is not valid, handle errors
            $errors = $this->getErrors();
            foreach ($errors as $attributeErrors) {
                foreach ($attributeErrors as $error) {
                    // Handle each error as needed, e.g., log it or display it
                    echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "\
";
                }
            }

            // Return false to indicate validation failure
            return false;
        }
    }
}

// Example usage
$formData = [
    'username' => 'JohnDoe',
    'email' => 'john.doe@example.com',
    'message' => 'This is a test message.',
];

$validator = new FormValidator();
if ($validator->validateData($formData)) {
    echo "Form data is valid.\
";
} else {
    echo "Form data is invalid.\
";
}

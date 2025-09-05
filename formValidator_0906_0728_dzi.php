<?php
// 代码生成时间: 2025-09-06 07:28:57
// FormValidator.php
// 这是一个简单的表单数据验证器类，用于在Yii框架中验证表单数据。
class FormValidator extends \CComponent {

    private $_errors = [];

    /**
     * 验证表单数据
     * 
     * @param array $data 需要验证的表单数据
     * @return bool 返回验证是否成功
     */
    public function validate($data) {
        // 清空之前的验证错误
        $this->_errors = [];

        // 验证规则
        if (!$this->validateName($data)) {
            $this->addError('name', 'Name is required.');
        }

        if (!$this->validateEmail($data)) {
            $this->addError('email', 'Email is required.');
        }

        // 检查是否还有未处理的验证错误
        if (count($this->_errors) > 0) {
            return false;
        }

        return true;
    }

    /**
     * 添加验证错误
     * 
     * @param string $attribute 属性名
     * @param string $message 错误信息
     */
    private function addError($attribute, $message) {
        $this->_errors[$attribute] = $message;
    }

    /**
     * 获取所有验证错误
     * 
     * @return array 返回所有验证错误
     */
    public function getErrors() {
        return $this->_errors;
    }

    /**
     * 验证姓名
     * 
     * @param array $data 表单数据
     * @return bool 返回姓名是否有效
     */
    private function validateName($data) {
        return isset($data['name']) && !empty($data['name']);
    }

    /**
     * 验证邮箱
     * 
     * @param array $data 表单数据
     * @return bool 返回邮箱是否有效
     */
    private function validateEmail($data) {
        return isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }

}

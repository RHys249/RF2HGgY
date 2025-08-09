<?php
// 代码生成时间: 2025-08-09 11:11:29
// 数据模型设计示例

/**
 * User Model
 * 这个模型代表一个用户，包含基本的用户信息
 */
class User extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    // 用户注册
    public function register($username, $email, $password)
    {
        if (empty($username) || empty($email) || empty($password)) {
            throw new CException('用户名、邮箱和密码不能为空');
        }

        if ($this->usernameExists($username)) {
            throw new CException('用户名已存在');
        }

        if ($this->emailExists($email)) {
            throw new CException('邮箱已注册');
        }

        $this->username = $username;
        $this->email = $email;
        $this->password = $this->hashPassword($password);

        if (!$this->save()) {
            throw new CException('用户注册失败');
        }
    }

    // 检查用户名是否存在
    protected function usernameExists($username)
    {
        return User::model()->find('username = :username', array(':username' => $username)) !== null;
    }

    // 检查邮箱是否存在
    protected function emailExists($email)
    {
        return User::model()->find('email = :email', array(':email' => $email)) !== null;
    }

    // 密码加密
    protected function hashPassword($password)
    {
        return md5($password . 'your_salt_here'); // 使用MD5加盐的方式进行密码加密
    }
}

/**
 * Product Model
 * 这个模型代表一个产品，包含产品信息
 */
class Product extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'products';
    }

    // 添加新产品
    public function addProduct($name, $description, $price)
    {
        if (empty($name) || empty($description) || empty($price)) {
            throw new CException('产品名称、描述和价格不能为空');
        }

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

        if (!$this->save()) {
            throw new CException('产品添加失败');
        }
    }
}

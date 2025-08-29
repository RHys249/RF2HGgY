<?php
// 代码生成时间: 2025-08-29 16:32:57
// TestDataGenerator.php
// 这个类用于生成测试数据
class TestDataGenerator
{
    private $data;

    // 构造函数
    public function __construct()
    {
        // 初始化测试数据
        $this->data = array();
    }

    // 生成随机字符串
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    // 生成测试用户数据
    public function generateUser()
    {
        try {
            $user = array();
            $user['username'] = $this->generateRandomString(5);
            $user['email'] = $user['username'] . "@example.com";
            $user['password'] = $this->generateRandomString(12);

            $this->data[] = $user;
            return $user;
        } catch (Exception $e) {
            // 错误处理
            echo "Error generating user data: " . $e->getMessage();
        }
    }

    // 获取所有生成的测试数据
    public function getData()
    {
        return $this->data;
    }
}

// 使用示例
$testDataGenerator = new TestDataGenerator();
for ($i = 0; $i < 10; $i++) {
    $user = $testDataGenerator->generateUser();
    print_r($user);
}

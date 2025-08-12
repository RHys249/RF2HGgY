<?php
// 代码生成时间: 2025-08-13 02:59:06
// testdata_generator.php
// 测试数据生成器

class TestDataGenerator {

    private $faker;

    public function __construct() {
        // 使用Faker库来生成测试数据
        $this->faker = Faker\Factory::create();
    }

    // 生成多个用户测试数据
    public function generateUsers($count) {
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'address' => $this->faker->address,
                'phone' => $this->faker->phoneNumber,
            ];
        }
        return $users;
    }

    // 生成多个产品测试数据
    public function generateProducts($count) {
        $products = [];
        for ($i = 0; $i < $count; $i++) {
            $products[] = [
                'name' => $this->faker->word,
                'price' => $this->faker->randomFloat(2, 0, 1000),
                'description' => $this->faker->text(200),
            ];
        }
        return $products;
    }

    // 错误处理函数
    private function handleError($message) {
        // 这里可以添加日志记录或其他错误处理机制
        echo "Error: {$message}";
    }

}

// 使用示例
try {
    $generator = new TestDataGenerator();
    $users = $generator->generateUsers(10);
    print_r($users);

    $products = $generator->generateProducts(5);
    print_r($products);
} catch (Exception $e) {
    // 处理任何可能的异常
    $generator->handleError($e->getMessage());
}

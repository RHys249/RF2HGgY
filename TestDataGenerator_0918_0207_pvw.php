<?php
// 代码生成时间: 2025-09-18 02:07:24
class TestDataGenerator
{

    /**
     * Generates an array of fake data for demonstration purposes.
     *
     * @param int $count The number of fake data entries to generate.
     * @return array
     */
    public function generateFakeData($count)
    {
        try {
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                $data[] = [
                    'name' => $this->generateRandomName(),
                    'email' => $this->generateRandomEmail(),
                    'address' => $this->generateRandomAddress()
                ];
            }
            return $data;
        } catch (Exception $e) {
            // Handle any exceptions and log them appropriately
            \Yii::error(\$e->getMessage(), __METHOD__);
            return [];
        }
    }

    /**
     * Generates a random name.
     *
     * @return string
     */
    private function generateRandomName()
    {
        return "John Doe " . rand(1, 100);
    }

    /**
     * Generates a random email address.
     *
     * @return string
     */
    private function generateRandomEmail()
    {
        $names = ["john", "jane", "doe", "example", "user"];
        return $names[array_rand($names)] . "@example.com";
    }

    /**
     * Generates a random address.
     *
     * @return string
     */
    private function generateRandomAddress()
    {
        return "123 Main St, Anytown, USA";
    }

}

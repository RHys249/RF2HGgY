<?php
// 代码生成时间: 2025-09-22 09:43:41
class TestDataGenerator
{
    // This function generates a random string of a given length
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // This function generates a random email address
    public function generateRandomEmail() {
        $email = $this->generateRandomString(8) . '@' . $this->generateRandomString(5) . '.com';
        return $email;
    }

    // This function generates a random integer within a given range
    public function generateRandomInteger($min = 0, $max = 100) {
        return rand($min, $max);
    }

    // This function generates a random floating point number within a given range
    public function generateRandomFloat($min = 0.0, $max = 100.0, $precision = 2) {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), $precision);
    }

    // This function generates a random date within a given range
    public function generateRandomDate($startDate, $endDate) {
        $timestamp = strtotime($startDate) + rand(0, strtotime($endDate) - strtotime($startDate));
        return date('Y-m-d', $timestamp);
    }

    // This function generates a random user profile
    public function generateRandomUserProfile() {
        return [
            'username' => $this->generateRandomString(8),
            'email' => $this->generateRandomEmail(),
            'age' => $this->generateRandomInteger(18, 60),
            'balance' => $this->generateRandomFloat(0.0, 1000.0),
            'registration_date' => $this->generateRandomDate('2020-01-01', '2023-01-01')
        ];
    }

    // This function generates a list of random user profiles
    public function generateRandomUserProfiles($count) {
        $profiles = [];
        for ($i = 0; $i < $count; $i++) {
            $profiles[] = $this->generateRandomUserProfile();
        }
        return $profiles;
    }
}

<?php
// 代码生成时间: 2025-09-10 00:15:24
// password_encryption_decryption.php
// 密码加密解密工具

class PasswordEncryptionDecryption {

    private $secretKey; // 用于加密和解密的密钥

    public function __construct($secretKey) {
        // 构造函数中设置密钥
        $this->secretKey = $secretKey;
    }

    // 加密密码
    public function encryptPassword($password) {
        try {
            // 使用openssl_encrypt进行加密
            $encryptedPassword = openssl_encrypt($password, 'AES-256-CBC', $this->secretKey, 0, $this->getIv());
            if ($encryptedPassword === false) {
                throw new Exception('Encryption failed: ' . openssl_error_string());
            }
            return base64_encode($encryptedPassword);
        } catch (Exception $e) {
            // 错误处理
            error_log('Encryption error: ' . $e->getMessage());
            return false;
        }
    }

    // 解密密码
    public function decryptPassword($encryptedPassword) {
        try {
            // 使用openssl_decrypt进行解密
            $password = openssl_decrypt(base64_decode($encryptedPassword), 'AES-256-CBC', $this->secretKey, 0, $this->getIv());
            if ($password === false) {
                throw new Exception('Decryption failed: ' . openssl_error_string());
            }
            return $password;
        } catch (Exception $e) {
            // 错误处理
            error_log('Decryption error: ' . $e->getMessage());
            return false;
        }
    }

    // 生成IV（初始向量）
    private function getIv() {
        // AES-256-CBC需要一个16字节长的IV
        return openssl_random_pseudo_bytes(16);
    }

}

// 使用示例
try {
    $secretKey = 'your_secret_key'; // 密钥应保密，并且足够复杂
    $encryptionDecryption = new PasswordEncryptionDecryption($secretKey);
    $originalPassword = 'my_password123';

    $encryptedPassword = $encryptionDecryption->encryptPassword($originalPassword);
    if ($encryptedPassword) {
        echo 'Encrypted password: ' . $encryptedPassword . '
';

        $decryptedPassword = $encryptionDecryption->decryptPassword($encryptedPassword);
        if ($decryptedPassword) {
            echo 'Decrypted password: ' . $decryptedPassword . '
';
        }
    }
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
}

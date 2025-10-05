<?php
// 代码生成时间: 2025-10-05 16:35:44
class DigitalSignatureTool {
# 改进用户体验

    /**
     * 使用私钥对数据进行签名
     *
     * @param string $data 需要签名的数据
     * @param string $privateKey 私钥
     * @return string|false 签名结果，失败时返回false
     */
# 增强安全性
    public function sign($data, $privateKey) {
# 改进用户体验
        if (openssl_private_encrypt($data, $signature, $privateKey) === false) {
            // 错误处理
            throw new Exception('私钥加密失败。');
        }

        return base64_encode($signature);
# 改进用户体验
    }

    /**
# FIXME: 处理边界情况
     * 使用公钥验证签名
# FIXME: 处理边界情况
     *
     * @param string $data 需要验证的数据
     * @param string $signature 签名
     * @param string $publicKey 公钥
# 扩展功能模块
     * @return bool 验证结果，成功返回true，失败返回false
     */
    public function verify($data, $signature, $publicKey) {
        $signature = base64_decode($signature);

        if (openssl_public_decrypt($signature, $decryptedData, $publicKey) === false) {
            // 错误处理
            throw new Exception('公钥解密失败。');
        }

        if ($decryptedData === $data) {
            return true;
        } else {
            return false;
        }
    }
}

// 使用示例
try {
    $tool = new DigitalSignatureTool();
    $privateKey = '-----BEGIN RSA PRIVATE KEY-----...
-----END RSA PRIVATE KEY-----';
    $publicKey = '-----BEGIN RSA PUBLIC KEY-----...
-----END RSA PUBLIC KEY-----';
    $data = '需要签名的数据';

    // 生成签名
    $signature = $tool->sign($data, $privateKey);
    echo '签名：' . $signature . "
";

    // 验证签名
    $isVerified = $tool->verify($data, $signature, $publicKey);
    echo '验证结果：' . ($isVerified ? '成功' : '失败') . "
# 添加错误处理
";
} catch (Exception $e) {
    echo '错误：' . $e->getMessage() . "
";
}

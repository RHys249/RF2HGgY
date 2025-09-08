<?php
// 代码生成时间: 2025-09-08 09:37:16
class NetworkConnectionChecker extends \yii\base\Component
{
    /**
     * @var string The URL to ping for checking network connection.
     */
    public $url = 'http://www.google.com';

    /**
     * Checks the network connection status by pinging the specified URL.
     *
     * @return bool Returns true if connection is successful, false otherwise.
     */
    public function checkConnection()
    {
        // Try to ping the URL
        try {
            $fp = @fsockopen($this->url, 80, $errno, $errstr, 10);
            
            if (!$fp) {
                // Connection failed
                throw new \yii\base\Exception("Connection to {$this->url} failed: $errstr ($errno)");
            } else {
                // Connection successful
                fclose($fp);
                return true;
            }
        } catch (\yii\base\Exception $e) {
            // Error handling
            \Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }
}

// Usage example
$checker = new NetworkConnectionChecker();
if ($checker->checkConnection()) {
    echo "Network connection is active.
";
} else {
    echo "Network connection is down.
";
}

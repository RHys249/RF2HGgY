<?php
// 代码生成时间: 2025-07-31 20:19:24
class ConfigManager 
{
    private $configPath;

    /**
     * Constructor to initialize the configuration path.
     * 
     * @param string $configPath The path to the configuration files.
     */
    public function __construct($configPath) 
    {
        $this->configPath = $configPath;
        if (!is_dir($this->configPath)) {
            throw new Exception("Configuration path does not exist: {$this->configPath}");
        }
    }

    /**
     * Load configuration from a specified file.
     * 
     * @param string $filename The name of the configuration file.
     * @return array The configuration array.
     */
    public function loadConfig($filename) 
    {
        $configFile = $this->configPath . DIRECTORY_SEPARATOR . $filename;
        if (!file_exists($configFile)) {
            throw new Exception("Configuration file does not exist: {$configFile}");
        }
        $config = parse_ini_file($configFile, true);
        if ($config === false) {
            throw new Exception("Failed to parse configuration file: {$configFile}");
        }
        return $config;
    }

    /**
     * Save configuration to a specified file.
     * 
     * @param string $filename The name of the configuration file.
     * @param array $configData The configuration data to save.
     * @return bool True on success, false on failure.
     */
    public function saveConfig($filename, $configData) 
    {
        $configFile = $this->configPath . DIRECTORY_SEPARATOR . $filename;
        $configString = ini_format($configData);
        if (file_put_contents($configFile, $configString) === false) {
            throw new Exception("Failed to save configuration file: {$configFile}");
        }
        return true;
    }
}

/**
 * Helper function to format an associative array into an INI string.
 * 
 * @param array $data The associative array to format.
 * @return string The INI formatted string.
 */
function ini_format($data) 
{
    $ini = "";
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $subKey => $subValue) {
                $ini .= "[{$key}.{$subKey}]
";
                $ini .= ini_format($subValue);
            }
        } else {
            $ini .= "$key = "$value"
";
        }
    }
    return $ini;
}

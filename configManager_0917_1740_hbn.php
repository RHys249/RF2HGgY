<?php
// 代码生成时间: 2025-09-17 17:40:01
class ConfigManager
{
    /**
     * @var string The path to the configuration file.
     */
    private $configFilePath;

    /**
     * Constructor for ConfigManager.
     *
     * @param string $configFilePath The path to the configuration file.
     */
    public function __construct($configFilePath)
    {
        $this->configFilePath = $configFilePath;
    }

    /**
     * Reads the configuration file and returns its contents as an associative array.
     *
     * @return array The configuration settings.
     * @throws Exception If the file cannot be read.
     */
    public function readConfig()
    {
        if (!file_exists($this->configFilePath)) {
            throw new Exception("Configuration file not found: {$this->configFilePath}");
        }

        return parse_ini_file($this->configFilePath, true);
    }

    /**
     * Writes the configuration settings to the file.
     *
     * @param array $config The configuration settings to write.
     * @return bool True on success, false on failure.
     * @throws Exception If the file cannot be written.
     */
    public function writeConfig($config)
    {
        $configString = $this->arrayToIni($config);
        if (false === file_put_contents($this->configFilePath, $configString)) {
            throw new Exception("Failed to write to configuration file: {$this->configFilePath}");
        }

        return true;
    }

    /**
     * Converts an associative array to a INI formatted string.
     *
     * @param array $array The array to convert.
     * @return string The INI formatted string.
     */
    private function arrayToIni($array)
    {
        $ini = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $ini .= "[$key]" . "
";
                foreach ($value as $k => $v) {
                    $ini .= "$k = "$v"
";
                }
            } else {
                $ini .= "$key = "$value"
";
            }
        }
        return $ini;
    }
}

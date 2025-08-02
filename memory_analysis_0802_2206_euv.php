<?php
// 代码生成时间: 2025-08-02 22:06:35
class MemoryAnalysis {

    /**
     * @var string The current memory limit of PHP script.
     */
    private $memoryLimit;

    /**
     * @var float The peak memory usage of the script.
     */
    private $peakMemoryUsage;

    /**
     * @var float The current memory usage of the script.
     */
    private $currentMemoryUsage;

    /**
     * Constructor for the MemoryAnalysis class.
     * It initializes the memory limit and memory usage.
     */
    public function __construct() {
        $this->memoryLimit = ini_get('memory_limit');
        $this->peakMemoryUsage = memory_get_peak_usage(true);
        $this->currentMemoryUsage = memory_get_usage(true);
    }

    /**
     * Gets the current memory limit of the PHP script.
     *
     * @return string The current memory limit.
     */
    public function getMemoryLimit() {
        return $this->memoryLimit;
    }

    /**
     * Gets the peak memory usage of the script.
     *
     * @return float The peak memory usage in bytes.
     */
    public function getPeakMemoryUsage() {
        return $this->peakMemoryUsage;
    }

    /**
     * Gets the current memory usage of the script.
     *
     * @return float The current memory usage in bytes.
     */
    public function getCurrentMemoryUsage() {
        return $this->currentMemoryUsage;
    }

    /**
     * Analyzes and returns the memory usage report.
     *
     * @return array An associative array containing memory usage data.
     */
    public function analyzeMemoryUsage() {
        try {
            // Get memory usage data
            $memoryData = [
                'memory_limit' => $this->getMemoryLimit(),
                'peak_memory_usage' => $this->getPeakMemoryUsage(),
                'current_memory_usage' => $this->getCurrentMemoryUsage()
            ];

            // Convert memory usage to a more readable format (e.g., KB, MB, GB)
            foreach ($memoryData as $key => &$value) {
                if ($key !== 'memory_limit') {
                    $value = $this->formatBytes($value);
                }
            }

            return $memoryData;
        } catch (Exception $e) {
            // Handle any exceptions that occur during memory analysis
            error_log('Error analyzing memory usage: ' . $e->getMessage());
            return ['error' => 'Failed to analyze memory usage'];
        }
    }

    /**
     * Formats the given bytes into a more readable format (e.g., KB, MB, GB).
     *
     * @param int $bytes The number of bytes to format.
     * @return string The formatted memory size.
     */
    private function formatBytes($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } else {
            $bytes = $bytes . ' bytes';
        }

        return $bytes;
    }
}

// Example usage of MemoryAnalysis class
try {
    $memoryAnalyzer = new MemoryAnalysis();
    $memoryReport = $memoryAnalyzer->analyzeMemoryUsage();
    echo '<pre>';
    print_r($memoryReport);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

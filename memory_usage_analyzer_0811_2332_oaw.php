<?php
// 代码生成时间: 2025-08-11 23:32:38
class MemoryUsageAnalyzer {

    /**
     * Analyze memory usage
     *
     * @return array
     */
    public function analyzeMemoryUsage() {
        try {
            // Get the memory usage of the current script
            $currentMemoryUsage = memory_get_usage();

            // Get the peak memory usage of the current script
            $peakMemoryUsage = memory_get_peak_usage();

            // Prepare the result array
            $memoryUsageResult = [
                'current' => $currentMemoryUsage,
                'peak' => $peakMemoryUsage
            ];

            // Return the result array
            return $memoryUsageResult;

        } catch (Exception $e) {
            // Handle any exceptions that occur during the process
            error_log('Error analyzing memory usage: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Display memory usage in a readable format
     *
     * @param int $memoryUsage
     * @return string
     */
    public function formatMemoryUsage($memoryUsage) {
        $memoryUsage = (int) $memoryUsage;
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $memoryUsage >= 1024 && $i < count($units) - 1; $i++) {
            $memoryUsage /= 1024;
        }

        return round($memoryUsage, 2) . ' ' . $units[$i];
    }
}

// Example usage
$memoryAnalyzer = new MemoryUsageAnalyzer();
$memoryUsageResult = $memoryAnalyzer->analyzeMemoryUsage();

if (isset($memoryUsageResult['error'])) {
    echo 'Error: ' . $memoryUsageResult['error'];
} else {
    echo 'Current Memory Usage: ' . $memoryAnalyzer->formatMemoryUsage($memoryUsageResult['current']) . "
";
    echo 'Peak Memory Usage: ' . $memoryAnalyzer->formatMemoryUsage($memoryUsageResult['peak']) . "
";
}
}
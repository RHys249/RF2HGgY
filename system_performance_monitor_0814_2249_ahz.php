<?php
// 代码生成时间: 2025-08-14 22:49:25
class SystemPerformanceMonitor {

    /**
     * Retrieves CPU usage as a percentage
     *
     * @return float CPU usage percentage
     */
    public function getCpuUsage() {
        if (!function_exists('sys_getloadavg')) {
            throw new Exception("Function 'sys_getloadavg' not available. This function requires a Unix-based OS.");
        }

        $load = sys_getloadavg();
        $cpu_load = $load[0] / ($this->getCpuCores() * 60);
        return $cpu_load * 100;
    }

    /**
     * Retrieves the number of CPU cores
     *
     * @return int Number of CPU cores
     */
    private function getCpuCores() {
        $cores = shell_exec('nproc');
        return (int)$cores;
    }

    /**
     * Retrieves memory usage
     *
     * @return array Memory usage details
     */
    public function getMemoryUsage() {
        $memory_usage = [];
        $memory_usage['total'] = function_exists('memory_get_usage') ? memory_get_usage() : 0;
        $memory_usage['free'] = function_exists('memory_get_usage') ? memory_get_usage(true) : 0;
        return $memory_usage;
    }

    /**
     * Retrieves disk usage for all partitions
     *
     * @return array Disk usage details
     */
    public function getDiskUsage() {
        $disk_usage = [];
        $disk_partitions = glob('/mnt/*');

        foreach ($disk_partitions as $partition) {
            $partition_stats = statvfs($partition);
            $disk_usage[$partition] = [
                'total' => $partition_stats[0],
                'free' => $partition_stats[fstatvfs($partition)['f_bavail'] * $partition_stats[4]],
                'used' => $partition_stats[0] - $partition_stats[fstatvfs($partition)['f_bavail'] * $partition_stats[4]]
            ];
        }

        return $disk_usage;
    }

}

// Example usage
try {
    $monitor = new SystemPerformanceMonitor();
    $cpu_usage = $monitor->getCpuUsage();
    $memory_usage = $monitor->getMemoryUsage();
    $disk_usage = $monitor->getDiskUsage();

    echo "CPU Usage: " . $cpu_usage . "%
";
    echo "Memory Usage: " . $memory_usage['total'] . " bytes used, " . $memory_usage['free'] . " bytes free
";
    echo "Disk Usage:
";
    foreach ($disk_usage as $partition => $usage) {
        echo "$partition:
";
        echo "  Total: " . $usage['total'] . " bytes
";
        echo "  Free: " . $usage['free'] . " bytes
";
        echo "  Used: " . $usage['used'] . " bytes
";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

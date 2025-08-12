<?php
// 代码生成时间: 2025-08-12 21:22:39
class SystemPerformanceMonitor {

    /**
     * Get CPU usage
     *
     * @return float CPU usage percentage
     */
    public function getCpuUsage() {
        // Use the 'top' command to get CPU usage
        // This is a Unix/Linux specific method
        $cpuUsage = shell_exec('top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk \x27{print 100 - $1}\x27');
        if ($cpuUsage === null) {
            // Handle error
            throw new Exception('Failed to get CPU usage');
        }
        return (float) $cpuUsage;
    }

    /**
     * Get memory usage
     *
     * @return float Memory usage percentage
     */
    public function getMemoryUsage() {
        // Use the 'free' command to get memory usage
        // This is a Unix/Linux specific method
        $memoryUsage = shell_exec('free -m | awk \x27NR==2{printf \x27%.2f\', $3/$2 * 100.0}\x27');
        if ($memoryUsage === null) {
            // Handle error
            throw new Exception('Failed to get memory usage');
        }
        return (float) $memoryUsage;
    }

    /**
     * Get disk usage
     *
     * @return float Disk usage percentage
     */
    public function getDiskUsage() {
        // Use the 'df' command to get disk usage
        // This is a Unix/Linux specific method
        $diskUsage = shell_exec('df -h / | awk \x27NR==2{print $5}\x27 | sed \x27s/%//\x27');
        if ($diskUsage === null) {
            // Handle error
            throw new Exception('Failed to get disk usage');
        }
        return (float) $diskUsage;
    }
}

// Usage example
try {
    $monitor = new SystemPerformanceMonitor();
    $cpuUsage = $monitor->getCpuUsage();
    $memoryUsage = $monitor->getMemoryUsage();
    $diskUsage = $monitor->getDiskUsage();

    echo "CPU Usage: $cpuUsage\%\
";
    echo "Memory Usage: $memoryUsage\%\
";
    echo "Disk Usage: $diskUsage\%\
";
} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
}

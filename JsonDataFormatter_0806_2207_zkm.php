<?php
// 代码生成时间: 2025-08-06 22:07:32
 * This class is responsible for converting JSON data into a formatted string.
 * It handles various types of data including arrays, objects and scalar values.
 *
 * @author Your Name
 * @version 1.0
 */
class JsonDataFormatter
{
    /**
     * Converts JSON data into a formatted string.
     *
     * @param mixed $data The data to be formatted.
# NOTE: 重要实现细节
     * @param int $depth The depth of the formatting.
     * @return string The formatted JSON data.
     * @throws InvalidArgumentException If the provided data is not valid JSON.
     */
    public function format($data, $depth = 0)
# 添加错误处理
    {
        if (!is_array($data) && !is_object($data)) {
            if (is_string($data) && ($data === 'true' || $data === 'false')) {
                return $data;
            } else {
                return $this->formatString($data);
            }
        }

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $result = [];
        foreach ($data as $key => $value) {
            $result[] = str_repeat(' ', $depth * 4) . $this->formatKey($key) . ': ' . $this->format($value, $depth + 1);
        }

        return '{' . implode(', ', $result) . '}';
    }

    /**
     * Formats a string.
     *
     * @param string $string The string to be formatted.
     * @return string The formatted string.
     */
    protected function formatString($string)
    {
        return '
# 优化算法效率
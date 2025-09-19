<?php
// 代码生成时间: 2025-09-20 02:14:07
class SortingAlgorithm {

    private $array;

    /**
     * Constructor to initialize the array to be sorted.
     *
     * @param array $array The array to be sorted.
     */
    public function __construct($array) {
        if (!is_array($array)) {
            throw new InvalidArgumentException('The input must be an array.');
        }
        $this->array = $array;
    }

    /**
     * Sort the array using bubble sort algorithm.
     *
     * @return array The sorted array.
     */
    public function bubbleSort() {
        $array = $this->array;
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Sort the array using selection sort algorithm.
     *
     * @return array The sorted array.
     */
    public function selectionSort() {
        $array = $this->array;
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            // Find the minimum element in unsorted array
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap the found minimum element with the first element
            $temp = $array[$minIndex];
            $array[$minIndex] = $array[$i];
            $array[$i] = $temp;
        }
        return $array;
    }

    /**
     * Sort the array using insertion sort algorithm.
     *
     * @return array The sorted array.
     */
    public function insertionSort() {
        $array = $this->array;
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;
            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $key;
        }
        return $array;
    }

    // Add more sorting algorithms as needed.

}

// Example usage:
try {
    $unsortedArray = [64, 34, 25, 12, 22, 11, 90];
    $sorter = new SortingAlgorithm($unsortedArray);
    echo 'Sorted array using bubble sort: ';
    print_r($sorter->bubbleSort());
    echo 'Sorted array using selection sort: ';
    print_r($sorter->selectionSort());
    echo 'Sorted array using insertion sort: ';
    print_r($sorter->insertionSort());
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage();
}

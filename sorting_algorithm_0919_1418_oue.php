<?php
// 代码生成时间: 2025-09-19 14:18:39
class SortingAlgorithm {

    /**
     * Bubble Sort algorithm
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public function bubbleSort(array $array): array {
        $length = count($array);
        for ($i = 0; $i < $length - 1; $i++) {
            for ($j = 0; $j < $length - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Selection Sort algorithm
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public function selectionSort(array $array): array {
        $length = count($array);
        for ($i = 0; $i < $length - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $length; $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap elements
            $temp = $array[$minIndex];
            $array[$minIndex] = $array[$i];
            $array[$i] = $temp;
        }
        return $array;
    }

    /**
     * Insertion Sort algorithm
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public function insertionSort(array $array): array {
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

    /**
     * Quick Sort algorithm
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public function quickSort(array $array): array {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        $pivot = array_shift($array);
        foreach ($array as $item) {
            if ($item <= $pivot) {
                $left[] = $item;
            } else {
                $right[] = $item;
            }
        }
        return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
    }

    /**
     * Merge Sort algorithm
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public function mergeSort(array $array): array {
        if (count($array) == 1) {
            return $array;
        }
        $mid = count($array) / 2;
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        return $this->merge($this->mergeSort($left), $this->mergeSort($right));
    }

    /**
     * Helper function to merge two sorted arrays
     *
     * @param array $left The left array
     * @param array $right The right array
     * @return array The merged sorted array
     */
    private function merge(array $left, array $right): array {
        $result = array();
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] < $right[0]) {
                array_push($result, array_shift($left));
            } else {
                array_push($result, array_shift($right));
            }
        }
        while (count($left) > 0) {
            array_push($result, array_shift($left));
        }
        while (count($right) > 0) {
            array_push($result, array_shift($right));
        }
        return $result;
    }

}

// Example usage:
$sortingAlgorithm = new SortingAlgorithm();
$array = array(3, 1, 4, 1, 5, 9, 2, 6, 5, 3, 5);
echo "Array before sorting: ";
print_r($array);

$sortedArray = $sortingAlgorithm->quickSort($array);
echo "Array after quick sort: ";
print_r($sortedArray);

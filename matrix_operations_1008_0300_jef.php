<?php
// 代码生成时间: 2025-10-08 03:00:36
class MatrixOperations {

    /**
     * Matrix addition
     *
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return array|false The resulting matrix on success, or false on error
     */
    public function add($matrixA, $matrixB) {
        if ($this->validateMatrixDimensions($matrixA, $matrixB)) {
            $rows = count($matrixA);
            $cols = count($matrixA[0]);

            $result = [];
            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $cols; $j++) {
                    $result[$i][$j] = $matrixA[$i][$j] + $matrixB[$i][$j];
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Matrix subtraction
     *
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return array|false The resulting matrix on success, or false on error
     */
    public function subtract($matrixA, $matrixB) {
        if ($this->validateMatrixDimensions($matrixA, $matrixB)) {
            $rows = count($matrixA);
            $cols = count($matrixA[0]);

            $result = [];
            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $cols; $j++) {
                    $result[$i][$j] = $matrixA[$i][$j] - $matrixB[$i][$j];
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Matrix multiplication
     *
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return array|false The resulting matrix on success, or false on error
     */
    public function multiply($matrixA, $matrixB) {
        if (count($matrixA[0]) === count($matrixB)) {
            $rowsA = count($matrixA);
            $colsA = count($matrixA[0]);
            $rowsB = count($matrixB);
            $colsB = count($matrixB[0]);

            $result = [];
            for ($i = 0; $i < $rowsA; $i++) {
                for ($j = 0; $j < $colsB; $j++) {
                    $result[$i][$j] = 0;
                    for ($k = 0; $k < $colsA; $k++) {
                        $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
                    }
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Validate matrix dimensions
     *
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return bool True if dimensions are valid, false otherwise
     */
    private function validateMatrixDimensions($matrixA, $matrixB) {
        $rowsA = count($matrixA);
        $colsA = count($matrixA[0]);
        $rowsB = count($matrixB);
        $colsB = count($matrixB[0]);

        if ($rowsA === $rowsB && $colsA === $colsB) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Calculate determinant of a square matrix
     *
     * @param array $matrix Square matrix
     * @return float|false The determinant on success, or false on error
     */
    public function determinant($matrix) {
        if ($this->isSquareMatrix($matrix)) {
            $size = count($matrix);
            if ($size === 1) {
                return $matrix[0][0];
            } else if ($size === 2) {
                return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
            } else {
                $det = 0;
                for ($i = 0; $i < $size; $i++) {
                    $det += ($i % 2 === 0 ? 1 : -1) * $matrix[0][$i] * $this->determinant($this->minor($matrix, 0, $i));
                }
                return $det;
            }
        } else {
            return false;
        }
    }

    /**
     * Check if a matrix is square
     *
     * @param array $matrix Matrix to check
     * @return bool True if square, false otherwise
     */
    private function isSquareMatrix($matrix) {
        $rows = count($matrix);
        $cols = count($matrix[0]);
        return $rows === $cols;
    }

    /**
     * Get the minor of a matrix
     *
     * @param array $matrix Matrix
     * @param int $row Row to remove
     * @param int $col Column to remove
     * @return array The minor matrix
     */
    private function minor($matrix, $row, $col) {
        $newMatrix = [];
        for ($i = 0; $i < count($matrix); $i++) {
            $newRow = [];
            for ($j = 0; $j < count($matrix[0]); $j++) {
                if ($i !== $row && $j !== $col) {
                    $newRow[] = $matrix[$i][$j];
                }
            }
            if ($i !== $row) {
                $newMatrix[] = $newRow;
            }
        }
        return $newMatrix;
    }
}

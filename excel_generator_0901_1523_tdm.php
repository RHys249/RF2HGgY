<?php
// 代码生成时间: 2025-09-01 15:23:35
// 引入YII框架的autoload文件
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelGenerator {

    /**
     * 创建Excel文件并写入数据
     *
     * @param array $data 需要写入Excel的数据数组
     * @param string $filename Excel文件名称
     * @return void
     */
    public function createExcelFile(array $data, string $filename): void
    {
        try {
            // 创建一个新的Spreadsheet对象
            $spreadsheet = new Spreadsheet();

            // 设置活动的sheet
            $sheet = $spreadsheet->getActiveSheet();

            // 写入数据到sheet
            foreach ($data as $row => $rowData) {
                foreach ($rowData as $col => $value) {
                    $sheet->setCellValueByColumnAndRow($col + 1, $row + 1, $value);
                }
            }

            // 设置文件名
            $writer = new Xlsx($spreadsheet);
            $filePath = __DIR__ . '/' . $filename;

            // 写入Excel文件
            $writer->save($filePath);

            echo "Excel文件已生成: {$filePath}";

        } catch (Exception $e) {
            // 错误处理
            echo "发生错误: " . $e->getMessage();
        }
    }
}

// 使用示例
$data = [
    [
        '姓名', '年龄', '职业'
    ],
    [
        '张三', '25', '工程师'
    ],
    [
        '李四', '30', '设计师'
    ]
];

$excel = new ExcelGenerator();
$excel->createExcelFile($data, 'example.xlsx');

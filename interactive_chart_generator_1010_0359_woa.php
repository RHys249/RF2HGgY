<?php
// 代码生成时间: 2025-10-10 03:59:24
// interactive_chart_generator.php
// 使用PHP和YII框架创建交互式图表生成器

require_once 'vendor/autoload.php';

use yii\db\Connection;
use yii\web\Application;
use yii\web\Response;
use yii\helpers\Json;
use yii\console\Controller;
use yii\db\Query;
use yii\db\Exception;

class ChartController extends Controller
{
    // 数据库连接信息
    private $db;
    
    public function __construct($db, $config = [])
    {
        $this->db = $db;
        parent::__construct($config);
    }
    
    // 生成图表数据
    public function actionGenerate()
    {
        try {
            // 从数据库获取数据
            $data = $this->fetchChartData();
            
            // 响应数据格式为JSON
            \Yii::$app->response->format = Response::FORMAT_JSON;
            
            // 返回图表数据
            return ['success' => true, 'data' => $data];
        } catch (Exception \$e) {
            // 错误处理
            return ['success' => false, 'error' => \$e->getMessage()];
        }
    }
    
    // 从数据库中获取图表数据
    private function fetchChartData()
    {
        $query = new Query();
        \$data = \$query->select('*')->from('chart_data')->all(\$this->db, false);
        return \$data;
    }
}

// 数据库配置
return [
    'id' => 'interactive-chart-generator',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => [
            'class' => Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=your_database',
            'username' => 'your_username',
            'password' => 'your_password',
            'charset' => 'utf8',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = Json::encode($response->data);
                    $response->formatters[\yii\web\Response::FORMAT_JSON] = [
                        'class' => 'yii\web\JsonResponseFormatter',
                        'prettyPrint' => YII_DEBUG,
                        'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    ];
                }
            },
        ],
    ],
];

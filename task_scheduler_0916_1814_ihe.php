<?php
// 代码生成时间: 2025-09-16 18:14:30
// 引入Yii框架的类和组件
require_once __DIR__ . '/../vendor/autoload.php';

// 使用Yii框架的组件
use yii\base\Component;
use yii\console\Controller;
use yii\console\ExitCode;

// TaskScheduler类继承自Component，用于处理任务调度
class TaskScheduler extends Component
{
    public $tasks = [];

    public function init()
    {
        parent::init();
        // 初始化任务数组
        $this->tasks = [
            'task1' => ['class' => 'Task1', 'interval' => 3600], // 每小时执行一次
            'task2' => ['class' => 'Task2', 'interval' => 86400], // 每天执行一次
        ];
    }

    public function run()
    {
        foreach ($this->tasks as $task) {
            $className = $task['class'];
            $interval = $task['interval'];
            if (!class_exists($className)) {
                echo 'Error: Task class ' . $className . ' does not exist.';
                continue;
            }
            // 创建任务实例并执行
            $taskInstance = new $className();
            if ($taskInstance instanceof TaskInterface) {
                $taskInstance->execute();
            } else {
                echo 'Error: ' . $className . ' must implement TaskInterface.';
            }
            // 等待下一次执行的时间间隔
            sleep($interval);
        }
    }
}

// TaskInterface定义了任务必须实现的方法
interface TaskInterface
{
    public function execute();
}

// Task1类实现了TaskInterface，代表一个具体的任务
class Task1 implements TaskInterface
{
    public function execute()
    {
        echo 'Task1 is executed.';
    }
}

// Task2类实现了TaskInterface，代表另一个具体的任务
class Task2 implements TaskInterface
{
    public function execute()
    {
        echo 'Task2 is executed.';
    }
}

// 控制台命令行入口
class TaskController extends Controller
{
    public function actionIndex()
    {
        $scheduler = new TaskScheduler();
        $scheduler->run();
        return ExitCode::OK;
    }
}

// 使用示例：
// 运行Yii框架的console控制器，执行定时任务调度器
// php yii task/index

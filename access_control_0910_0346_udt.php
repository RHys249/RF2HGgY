<?php
// 代码生成时间: 2025-09-10 03:46:45
// access_control.php
// 这是一个简单的YII框架访问权限控制示例

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use Yii;

class AccessControlController extends Controller
{
    // 行为前过滤器
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // 检查用户是否已登录
        if (!Yii::$app->user->isGuest) {
            // 检查用户角色
            $role = Yii::$app->user->identity->role;
            // 根据角色授予或拒绝访问
            if ($role !== 'admin') {
                throw new ForbiddenHttpException('You do not have permission to access this page.');
            }
        } else {
            // 如果用户未登录，重定向到登录页面
            return $this->redirect(['site/login']);
        }

        return true; // 如果一切正常，允许行为执行
    }

    // 示例行为：仅管理员可以访问
    public function actionAdminOnly()
    {
        return 'This page is only for admins.';
    }
}

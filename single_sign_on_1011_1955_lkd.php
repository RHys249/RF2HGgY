<?php
// 代码生成时间: 2025-10-11 19:55:48
// 引入 Yii 框架的自动加载文件
require_once('vendor/autoload.php');

use Yii;
use yii\db\Exception;
use yii\web\Controller;

/*
 * 单点登录系统控制器
 */
class SingleSignOnController extends Controller
{
    private $_allowedDomains = ['domain1.com', 'domain2.com'];

    /*
     * 单点登录入口方法
     * @param string $returnUrl 登录成功后跳转的地址
     * @return string|\yii\web\Response
     */
    public function actionLogin($returnUrl = '')
    {
        try {
            // 检查请求来源域名是否允许
            $requestDomain = Yii::$app->request->getHostInfo();
            if (!in_array($requestDomain, $this->_allowedDomains)) {
                throw new Exception('Unauthorized domain.');
            }

            // 检查是否已经登录
            if (!Yii::$app->user->isGuest) {
                // 如果已经登录，则直接跳转到返回地址
                return $this->redirect($returnUrl);
            }

            // 执行登录逻辑，这里简化为直接设置用户为已登录状态
            Yii::$app->user->login(new \app\models\User(['username' => 'admin']));

            // 登录成功后跳转
            return $this->redirect($returnUrl);

        } catch (Exception $e) {
            // 错误处理
            Yii::error('Login error: ' . $e->getMessage());
            return $this->render('error', ['message' => $e->getMessage()]);
        }
    }

    /*
     * 登出方法
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}

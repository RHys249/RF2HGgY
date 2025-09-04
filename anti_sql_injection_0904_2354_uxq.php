<?php
// 代码生成时间: 2025-09-04 23:54:34
// 防止SQL注入示例程序
// 使用Yii框架的ActiveRecord模式来防止SQL注入
// 代码结构清晰，易于理解，包含适当的错误处理和注释

use Yii;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;
use yii\web\Controller;

class AntiInjectionController extends Controller
{
    /**
     * 显示用户列表并防止SQL注入
     *
     * @return string
     */
    public function actionIndex()
    {
        // 使用Yii的查询构造器创建安全的查询
        $query = (new 
            yii\db\Query())
            ->select(['id', 'username', 'email'])
            ->from('users')
            ->where(['active' => 1]);

        $dataProvider = new yii\data\ActiveDataProvider(['query' => $query]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 创建用户，防止SQL注入
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User(); // User是继承自ActiveRecord的模型

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // 其他CRUD操作可以类似地实现，利用ActiveRecord防止SQL注入
}


// User模型，继承自ActiveRecord
class User extends ActiveRecord
{
    // 使用 Yii 的 ActiveRecord 属性和方法来定义和操作数据库记录
    // 这里不需要手动编写SQL语句，Yii会自动处理防止SQL注入

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    // 其他模型方法...
}

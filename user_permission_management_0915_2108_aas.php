<?php
// 代码生成时间: 2025-09-15 21:08:28
// 用户权限管理系统
// 使用Yii框架实现

require_once('path/to/yii/framework/yii.php');
require_once('path/to/your/config/main.php');

Yii::import('application.models.*');

class UserPermissionManagementController extends Controller
{
    // 显示用户权限列表
    public function actionIndex()
    {
        try {
            $userPermissions = UserPermission::model()->findAll();
            if (empty($userPermissions)) {
                throw new CHttpException(404, 'No user permissions found.');
            }
            $this->render('index', array('userPermissions' => $userPermissions));
        } catch (Exception $e) {
            $this->render('error', array('message' => $e->getMessage()));
        }
    }

    // 添加新用户权限
    public function actionCreate()
    {
        try {
            $model = new UserPermission();
            if (isset($_POST['UserPermission'])) {
                $model->attributes = $_POST['UserPermission'];
                if ($model->save()) {
                    $this->redirect(array('index'));
                } else {
                    $this->render('create', array('model' => $model));
                }
            } else {
                $this->render('create', array('model' => $model));
            }
        } catch (Exception $e) {
            $this->render('error', array('message' => $e->getMessage()));
        }
    }

    // 更新用户权限
    public function actionUpdate($id)
    {
        try {
            $model = UserPermission::model()->findByPk($id);
            if ($model === null) {
                throw new CHttpException(404, 'User permission not found.');
            }
            if (isset($_POST['UserPermission'])) {
                $model->attributes = $_POST['UserPermission'];
                if ($model->save()) {
                    $this->redirect(array('index'));
                } else {
                    $this->render('update', array('model' => $model));
                }
            } else {
                $this->render('update', array('model' => $model));
            }
        } catch (Exception $e) {
            $this->render('error', array('message' => $e->getMessage()));
        }
    }

    // 删除用户权限
    public function actionDelete($id)
    {
        try {
            $model = UserPermission::model()->findByPk($id);
            if ($model === null) {
                throw new CHttpException(404, 'User permission not found.');
            }
            $model->delete();
            $this->redirect(array('index'));
        } catch (Exception $e) {
            $this->render('error', array('message' => $e->getMessage()));
        }
    }
}

class UserPermission extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_permissions';
    }

    public function rules()
    {
        return array(
            array('name, description', 'required'),
            array('name', 'unique'),
            array('name', 'length', 'max' => 255),
            array('description', 'length', 'max' => 1000),
            array('name, description', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}

?>
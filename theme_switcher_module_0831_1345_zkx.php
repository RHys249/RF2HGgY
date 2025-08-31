<?php
// 代码生成时间: 2025-08-31 13:45:24
// theme_switcher_module.php
// Yii框架模块，实现主题切换功能

class ThemeSwitcherModule extends CWebModule
{
    // 模块的配置数组
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'application.models.*',
            'application.components.*',
        ));
    }

    // 获取当前主题
    public function getCurrentTheme()
    {
        // 从session中获取主题
        return Yii::app()->session['theme'];
    }

    // 设置主题
    public function setTheme($themeName)
    {
        // 检查主题是否存在
        if (!in_array($themeName, $this->getAvailableThemes())) {
            throw new CException('Invalid theme name.');
        }

        // 设置session中的主题
        Yii::app()->session['theme'] = $themeName;
    }

    // 获取可用的主题数组
    public function getAvailableThemes()
    {
        // 这里简单返回预定义的主题名称数组
        // 实际应用中可能需要从数据库或配置文件中获取
        return array('default', 'dark', 'light');
    }

    // 检查是否有主题切换请求，并执行切换
    public function checkThemeChange()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $themeName = Yii::app()->request->getParam('theme');
            try {
                $this->setTheme($themeName);
                echo CJSON::encode(array('status' => 'success', 'message' => 'Theme switched successfully.'));
            } catch (CException $e) {
                echo CJSON::encode(array('status' => 'error', 'message' => $e->getMessage()));
            }
        }
    }
}

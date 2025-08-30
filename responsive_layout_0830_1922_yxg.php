<?php
// 代码生成时间: 2025-08-30 19:22:23
// Include Yii framework bootstrap file
require_once('path/to/yii/framework/yii.php');

// Define the application configuration
$config = array(
    "basePath" => dirname(__FILE__),
    "name" => 'Responsive Layout Application',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'Enter Your Password Here',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    // Other configuration options...
    );

// Create and run the application instance
Yii::createWebApplication($config)->run();

?>{* View file *}

{/* responsive_layout.php */}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Responsive Layout with Yii</title>
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <div id="content">
        <!-- Dynamic content goes here -->
        <h1>Welcome to the Responsive Layout</h1>
        <p>This layout adjusts based on the device type.</p>
    </div>
    <script src="js/responsive.js"></script>
</body>
</html>

<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 定义ThinkPHP框架路径
define('THINK_PATH', './../ThinkPHP');
//定义项目名称和路径
define('APP_NAME', 'LogiTechBrowser');
define('APP_PATH', '.');
//define('RUNTIME_ALLINONE',true); 
// 加载框架公共入口文件
require(THINK_PATH."/ThinkPHP.php");
//echo "index.php";
//实例化一个网站应用实例
App::run();
?>

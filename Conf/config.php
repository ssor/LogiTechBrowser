<?php
return array(
	//'配置项'=>'配置值'
	'TEMPLATE_FILE_PATH' => './download/',
    'URL_MODEL'=>1, // 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'=>'pdo',
	'DB_DSN' => 'sqlite:'.dirname(__FILE__).'/test.db3', //相对于config目录的路径
	'DB_NAME'=>'test.db3',
	'APP_DEBUG' => 1,
	'COMPANY_SIGN' => '北京动思科技发展有限公司'
);
?>
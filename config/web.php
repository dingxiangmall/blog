<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
	'layout'=>'main',
	'language'=>'zh-CN',
	'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','rest-client'],
    'components' => [
		/*
			
			$oss = \Yii::$app->get('oss');
			$fh = '/vagrant/php/baseapi/web/storage/image/824edb4e295892aedb8c49e4706606d6.png';
			$oss->upload('824edb4e295892aedb8c49e4706606d6.png', $fh);

			或者

			$oss->upload('storage/image/824edb4e295892aedb8c49e4706606d6.png', $fh); // 会自动创建文件夹

			其他用法

			$oss->createDir('storage/image/'); //创建文件夹
			$oss->delete('824edb4e295892aedb8c49e4706606d6.png'); // 删除文件
			$oss->delete('storage/image/824edb4e295892aedb8c49e4706606d6.png'); // 删除文件，如果这个文件是此文件夹的最后一个文件，则会把文件夹一起删除
			$oss->delete('storage/image/'); // 删除文件夹，但是要确保是空文件夹
			$oss->getAllObject(); // 获取根目录下的所有文件名，默认是100个
			$oss->getAllObject(['prefix' => 'storage/image/']); // 获取 `storage/image/` 目录下的所有文件名，默认是100个
		*/
		'oss'=>[
			'class' => 'yiier\AliyunOSS\OSS',
			'accessKeyId' => 'xxxxx', // 阿里云OSS AccessKeyID
			'accessKeySecret' => 'xxxx', // 阿里云OSS AccessKeySecret
			'bucket' => 'xxx', // 阿里云的bucket空间
			'lanDomain' => 'oss-cn-hangzhou-internal.aliyuncs.com', // OSS内网地址
			'wanDomain' => 'oss-cn-hangzhou.aliyuncs.com', //OSS外网地址
			'isInternal' => true // 上传文件是否使用内网，免流量费（选填，默认 false 是外网）
		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oouir-Z4ZSrMxb9G4_jSHK5PwcyppY-7',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
			'viewPath'=>'@app/mailer',
            'useFileTransport' => false,
			'transport'=>[
				'class'=>'Swift_SmtpTransport',
				'host'=>'smtp.126.com',
				'username'=>'yuanheng110@126.com',
				'password'=>'xing-jws@tom.com',
				'port'=>'587',
				'encryption'=>'tls',
			],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
				[
					'class'=>'yii\log\EmailTarget',
					'levels'=>['error'],
					'categories'=>['yii\db\*'],
					'message'=>[
						'from'=>['yuanheng110@126.com'],
						'to'=>['965177646@qq.com'],
						'subject'=>'databases errors at blog',
					],
				],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
	'modules'=>[
		'webshell'=>[
			'class'=>'samdark\webshell\Module',
			'allowedIPs'=>['*'],
			/* 'checkAccessCallback' => function (\yii\base\Action $action) {
                // return true if access is granted or false otherwise
                return true;
            } */
		],
		'rest-client'=>[
			'class'=>'zhuravljov\yii\rest\Module',
			'baseUrl'=>'http://blog.56gang.com.cn/api/v1',
			'allowedIPs'=>['*'],
		],
		'redactor'=>'yii\redactor\RedactorModule',
		'imageAllowExtensions'=>['jpg','png','gif'],
		/* 'user'=>[
			
		], */
		'gridview'=>[
			'class'=>'\kartik\grid\Module',
			'downloadAction'=>'export/download',
		],
		'user'=>[
			'class'=>'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin']
		],
	],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs'=>["*"],
    ];
}

return $config;

<?php
	if(!defined('LIBRARIES')) die("Error");
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	define('ROOT',__DIR__);
	define('NN_MSHD','soleaz');
	$config = array(
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/soleaz/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname' => 'soleaz',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => false,
			'secret' => '$soleaz@',
			'salt' => 'N1$&Yo$F,2',
			'debug-developer' => true,
			'debug-css' => true,
			'debug-js' => true,
			'index' => false,
			'reponsive' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				'en'=>'Tiếng Anh',
				'tl'=>'Tiếng Philippines'
			),
			'lang-doc' => 'en',
			'slug' => array(
				'en'=>'Tiếng Anh'
			),
			'seo' => array(
				'en'=>'Tiếng Anh'
			),
			'comlang' => array(
				"gioi-thieu" => array("vi"=>"gioi-thieu"),
				"san-pham" => array("vi"=>"san-pham"),
				"tin-tuc" => array("vi"=>"tin-tuc"),
				"tuyen-dung" => array("vi"=>"tuyen-dung"),
				"thu-vien-anh" => array("vi"=>"thu-vien-anh"),
				"video" => array("vi"=>"video"),
				"lien-he" => array("vi"=>"lien-he")
			)
		),
		'order' => array(
			'check' => true,
			'coupon' => true,
			'ship' => false
		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => false,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
				'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
			)
		),
		'ckeditor' => array(
			'folder' => "upload/ckfinder/"
		)
	);
	error_reporting(($config['website']['error-reporting']) ? E_ALL & ~E_NOTICE : 0);
	if($config['arrayDomainSSL']) require_once LIBRARIES."checkSSL.php";
	$http = 'http';
    if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $http .= "s";
    $http .= "://";
	$config_base = $http.$config['database']['server-name'].$config['database']['url'];
	$_SESSION['baseUrl'] = $config_base.$config['ckeditor']['folder'];
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];
	require_once LIBRARIES."constant.php";
?>
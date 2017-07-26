<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

//全てのエラーを表示
error_reporting(E_ALL);

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

//timezoneを日本に
date_default_timezone_set('Asia/Tokyo');

//.envの読み込み
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

//twigの設定
$basedir = dirname(__DIR__);
$loader = new \Twig_Loader_Filesystem($basedir . '/view/template');
$twig = new \Twig_Environment($loader, [
    'cache' => $basedir . '/cache/twig',
    'debug' => true,
]);

$db_name = getenv('DB_NAME');
$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');

ORM::configure([
    'connection_string' => "mysql:dbname=$db_name;host=$db_host:$db_port:/tmp/mysql.sock;charset=utf8mb4",
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'driver_options' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    ]
]);


$thread = \Model::factory('\SizukuBBS\models\Thread')->findOne(1);

$posts = $thread->posts()->find_many();
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


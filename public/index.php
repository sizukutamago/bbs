<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

//全てのエラーを表示
error_reporting(E_ALL);

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

//.envの読み込み
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

var_dump(getenv('DB_HOST'));
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

//DB接続
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

//ルーティング
$routes = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/', '\SizukuBBS\Controllers\TopController@index');
    $r->get('/category/{id:^[0-9]+$}', '\SizukuBBS\Controllers\ThreadController@showCategory');
    $r->get('/thread/{id:^[0-9]+$}', '\SizukuBBS\Controllers\ThreadController@showThread');
    $r->post('/thread/{id:^[0-9]+$}', '\SizukuBBS\Controllers\ThreadController@postMessage');
    $r->get('/thread/create', '\SizukuBBS\Controllers\ThreadController@showCreateThread');
    $r->post('/thread/create', '\SizukuBBS\Controllers\ThreadController@createThread');
});

// リクエストパラメータを取得する
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// リクエストURLからクエリストリング(?foo=bar)を除去したうえで、URIデコードする
$pos = strpos($uri, '?');
if ($pos !== false) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $routes->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        // ルーティングに従って処理を実行
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode('@', $handler, 2);
        $ref = new \ReflectionClass($class);
        $instance = $ref->newInstance();
        call_user_func_array([$instance, $method], [$vars]);
        break;

    case FastRoute\Dispatcher::NOT_FOUND:
        // Not Foundだった時
        header("HTTP/1.1 404 Not Found");
        echo "404 Not Found.";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Method Not Allowedだった時
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed.  allow only=" . json_encode($allowedMethods);
        break;

    default:
        echo "500 Server Error.";
        break;
}

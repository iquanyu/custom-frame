<?php
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Fluent;

require __DIR__ . '/../vendor/autoload.php';

//实例化服务容器、注册事件、路由服务提供服务者
$app = new Illuminate\Container\Container;

Illuminate\Container\Container::setInstance($app);

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();


//启动 Eloquent ORM模块并进行相关配置

$manager = new Manager();
$manager->addConnection(require '../config/database.php');
$manager->bootEloquent();

$app->instance('config', new Fluent);
$app['config']['view.compiled'] = __DIR__ . '/../storage/framework/views';
$path = __DIR__ . '/../resources/views';
$app['config']['view.paths'] = [$path];
with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();


//加载路由
require __DIR__ . '/../routes/web.php';

//实例化请求并分发处理请求

$request = Illuminate\Http\Request::createFromGlobals();

$response = $app['router']->dispatch($request);

$response->send();
?>
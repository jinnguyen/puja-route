# puja-route
Puja-Route is a router component, that allow to parse request to module/controller/action

<strong>Install</strong>
<pre>composer require jinnguyen/puja-route</pre>

<strong>Usage</strong>
```php
include /path/to/vendor/autoload.php;
$config = array(
    'root_namespace' => '\\Puja\\Route\\Demo\\', // You can change to match with controller class name on your app
    'default_controller' => 'Index', // Default controller
    'default_action' => 'index', // Default action
    'controller_dir' => __DIR__ . '/Controller/', // Folder that includes controllers, controller must have prefix is Controller and file type is .php (Ex:  UserController.php/IndexController.php, ...)
    'module_dir' => __DIR__ . '/Module/', // Folder that includes app modules
    'cache_dir' => __DIR__ . '/cache/', // Cache folder will store cached routers
);

$router = new Puja\Route\Route($config); // when you build, it will scan all file *Controller.php in $config[controller_dir] and /Controller/*Controller.php in $config[module_dir]
```

<strong>Add more route</strong>

If your controller is not in $config[controller_dir] and $config[module_dir]/<module>/Controller/, you can also add it to route by this command:
```php
$route->addRoute('/testaddroute', '\\Test\\Add\\Route\\Namespace');
```

<strong>Build</strong>

Scan all controller files and build routes from $config[controller_dir] and $config[module_dir] and controllers that was added by $router->addRoute()
```php
$router->build();
```

<strong>Get route</strong>

Get router information: module, controller, action, ..
```php
$router->getRoute('testaddroute') // get route at  of testaddroute
```

Note:
- $router->getRoute() must run after $router->build() otherwise it will get exception
- Should call $router->build() after all $router->addRoute(), otherwise all added routes will be missed.

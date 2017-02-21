<?php
include __DIR__ . '/../vendor/autoload.php';
$config = array(
    'root_namespace' => '\\Puja\\Route\\Demo\\',
    'default_controller' => 'Index',
    'default_action' => 'index',
    'controller_dir' => __DIR__ . '/Controller',
    'module_dir' => __DIR__ . '/Module/',
    'cache_dir' => __DIR__ . '/cache/',
);

$router = new Puja\Route\Route($config);
$router->addRoute('testadd/key', '\\Puja\\Route\\Demo\\AddRouteController');
$router->build();
print_r($router->getRoute('testadd/key'));

<?php
namespace Puja\Route;
class Route
{
    protected $builder;
    protected $config = array(
        'root_namespace' => 'Puja\\Route\\Demo\\',
        'default_controller' => 'Index',
        'default_action' => 'index',
        'exclude_controller' => array(),
        'exclude_action' => array(),
        'controller_dir' => null,
        'module_dir' => null,
        'cache_dir' => null,
    );

    public function __construct(array $config = array())
    {
        if (empty($config['cache_dir'])) {
            throw new Exception('$config[cache_dir] is required');
        }

        $this->config = array_merge($this->config, $config);
        $this->builder = new Router\Builder($this);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function build()
    {
        $this->builder->buildRoutes();
    }

    public function addRoute($route, $controllerCls)
    {
        $this->builder->addRoute($route, $controllerCls);
    }

    public function getRoute($route = null)
    {
        return $this->builder->getRoute($route);
    }

    public static function getRoutes()
    {
        return Router\Builder::getRoutes();
    }
}

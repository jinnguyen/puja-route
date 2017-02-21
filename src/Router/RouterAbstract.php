<?php
namespace Puja\Route\Router;
abstract class RouterAbstract
{
	protected $route;
	protected $config;
	public function __construct(\Puja\Route\Route $route)
	{
		$this->route = $route;
		$this->config = $this->route->getConfig();
		$this->init();
	}

	protected function init(){}
}
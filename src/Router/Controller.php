<?php
namespace Puja\Route\Router;
use Puja\Route\Exception;

class Controller extends RouterAbstract
{
	protected $routes;
    /**
     * @var Entity
     */
    protected $entity;
    protected function init()
    {
        $this->entity = new Entity($this->route);
    }

    public function build($controllerCls, $route = null, $moduleId = null, $controllerId = null, $fetchAction = true)
	{

		if (empty($controllerCls)) {
			return null;
		}

        if (!class_exists($controllerCls)) {
            throw new Exception('Class ' . $controllerCls . ' doesnt exist!');
        }

		/*if (empty($fetchAction)) {
			$this->getRoute($controllerCls, $route, $moduleId);
			return null;
		}*/

		$methods = get_class_methods($controllerCls);
        if (empty($methods)) {
            return null;
        }

        //$this->getRoute($controllerCls, $route, $moduleId, $controllerId);
        foreach ($methods as $method) {
            if (substr($method, -6) != 'Action') {
                continue;
            }

            $actionId = substr($method, 0, -6);
            if (in_array($actionId, $this->config['exclude_action'])) {
                continue;
            }
            $this->getRoute($controllerCls, $route, $moduleId, $controllerId, $actionId);
        }

        if (method_exists($controllerCls, 'actions')) {
            $this->buildFromActions($controllerCls, $route, $moduleId, $controllerId);
        }
	}

	protected function getRoute(
		$controllerCls,
		$route = null,
		$moduleId = null,
		$controllerId = null,
		$actionId = null,
		$annotation = false
	) {


        if ($actionId == 'index') {
            $actionId = null;
        }

        list ($key, $router) = $this->getEntry(
            $controllerCls,
            $route,
            $moduleId,
            $controllerId,
            $actionId,
            $annotation
        );
        $this->routes[$key] = $router;

        if ($controllerId == 'Index') {
            $controllerId = null;
            list ($key, $router) = $this->getEntry(
                $controllerCls,
                $route,
                $moduleId,
                $controllerId,
                $actionId,
                $annotation
            );
            $this->routes[$key] = $router;
        }
	}

    protected function getEntry(
        $controllerCls,
        $route = null,
        $moduleId = null,
        $controllerId = null,
        $actionId = null,
        $annotation = false
    )
    {
        return $this->entity->build(array(
            'route' => $route,
            'controller' => $controllerCls,
            'moduleId' => $moduleId,
            'controllerId' => $controllerId,
            'actionId' => $actionId,
            'annotation' => $annotation,
        ));
    }


	protected function buildFromActions($controllerCls, $route, $moduleId, $controllerId)
    {
        $actions = $controllerCls::actions();
        if (empty($actions)) {
            return null;
        }

        foreach ($actions as $actionId => $actionCls) {
            if (!class_exists($actionCls)) {
                throw new Exception('Class ' . $actionCls . ' doesnt exist!');
            }

            $this->getRoute($controllerCls, $route, $moduleId, $controllerId, $actionId, $actionCls);
        }
    }

    public function getRoutes()
    {
    	return $this->routes;
    }
}
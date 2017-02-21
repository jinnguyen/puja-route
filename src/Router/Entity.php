<?php
namespace Puja\Route\Router;
class Entity extends RouterAbstract
{
	protected $options = array(
		'route' => null,
		'controller' => null,
		'moduleId' => null,
		'controllerId' => null,
		'actionId' => null,
		'annotation' => false,
		'default_controller' => null,
		'default_action' => null,
	);

	public function build($options)
	{
		$options = array_intersect_key($options, $this->options);
		$keys = array();

		if ($options['route']) {
            $keys['route'] = $options['route'];
        } else {
        	if ($options['moduleId']) {
	            $keys['module'] = $options['moduleId'];
	        }

	        if ($options['controllerId']) {
	            $keys['controller'] = $options['controllerId'];
	        }
        }        

        if ($options['actionId']) {
            $keys['action'] = $options['actionId'];
        }

        if (empty($options['controllerId'])) {
            $options['controllerId'] = $this->config['default_controller'];
        }

        if (empty($options['actionId'])) {
            $options['actionId'] = $this->config['default_action'];
        }

        return array(
        	strtolower(implode('/', $keys)),
        	array(
	            'controller' => $options['controller'],
	            'annotation' => !empty($options['annotation']),
	            'action' => $options['annotation'] ? $options['annotation'] : $options['actionId']  . 'Action',
	            'moduleId' => strtolower($options['moduleId']),
	            'controllerId' => strtolower($options['controllerId']),
	            'actionId' => strtolower($options['actionId']),
        	)
        );
	}
}
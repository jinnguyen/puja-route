<?php
namespace Puja\Route\Demo\Controller;
class ContactController extends BaseController
{
    public function indexAction()
    {

    }
    
    public static function actions()
    {
    	return array(
    		'email' => 'Puja\Route\Demo\Action\Contact\Email',
    		'email2' => 'Puja\Route\Demo\Action\Contact\Email2',
    		'send' => 'Puja\Route\Demo\Action\Contact\Send',
    	);
    }

    public function sendAction()
    {
    }
}
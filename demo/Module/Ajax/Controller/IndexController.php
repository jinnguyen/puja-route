<?php
namespace Puja\Route\Demo\Module\Ajax\Controller;
class IndexController {

    public function sendAction()
    {

    }

    public function contactAction()
    {

    }

    public static function actions()
    {
        return array(
            'index' => 'Puja\Route\Demo\Action\Contact\Email',
        );
    }
}
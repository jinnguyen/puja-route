<?php
namespace Puja\Route\Demo\Controller;
class BaseController
{
	public function __construct($id)
	{
		echo '__construct'; exit;
	}
}
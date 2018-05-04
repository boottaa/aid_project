<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AidView\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		$this->layout()->setTemplate("layout/layout");
		return parent::onDispatch($e);
	}

	/**
	 * URL: /aidview/orders
	 */
    public function ordersAction()
    {
	    return new ViewModel();
    }

	/**
	 * URL: /aidview/employees
	 */
    public function employeesAction()
    {

		return new ViewModel();
    }


}

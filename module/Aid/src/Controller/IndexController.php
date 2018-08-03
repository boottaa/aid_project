<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Model\ApiAccess;
use Zend\Log\Logger;
use Zend\Mvc\MvcEvent;

class IndexController extends Base
{
	public function __construct(Logger $logger, ApiAccess $apiAccess, \Aid\JsonRpc\Server $rpcServer)
	{
		$this->setLogger($logger);
		$this->setApiAccess($apiAccess);
		$this->setRpcServer($rpcServer);
	}

	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		//Преобразовываем в массив и передаем...
		$hash = str_split($this->params()->fromRoute('hash', ''));

		$checkAccess = $this->getApiAccess()->checkAccess($hash);

		if(empty($checkAccess['id']) && ('POST' == $_SERVER['REQUEST_METHOD']))
		{
			$this->getRpcServer()->fault("Access denied!", 403);
		}

		return parent::onDispatch($e);
	}

	/**
	 * @inheritdoc: /aid/k33f3c8db70d437ce41cfbd1bbde0f413/run/orders (model name)
	 */
    public function runAction()
    {
        $this->run();
    }



}

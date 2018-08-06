<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Model\ApiAccess;
use Aid\Model\Orders;
use Zend\Json\Server\Exception\BadMethodCallException;
use Zend\Log\Logger;
use Zend\Mvc\MvcEvent;

class IndexController extends Base
{
    private $test = [];

	public function __construct(Logger $logger, ApiAccess $apiAccess, \Aid\JsonRpc\Server $rpcServer, array $test = [])
	{
		$this->setLogger($logger);
		$this->setApiAccess($apiAccess);
		$this->setRpcServer($rpcServer);

		$this->test = $test;
	}

	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		$hash = $this->params()->fromRoute('hash', '');
		$checkAccess = $this->getApiAccess()->checkAccess(str_split($hash));

        if (empty($checkAccess['id']) && ('POST' == $_SERVER['REQUEST_METHOD'])) {
            $this->getRpcServer()->fault("Access denied!", 403);
        } elseif (empty($checkAccess['id'])) {
            throw new BadMethodCallException("BAD KEY: " . $hash);
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


    //Тест модел
    public function teAction()
    {
        /**
         * @var $o Orders
         */
        $o = $this->test['orders'];
        
        echo __FILE__."<hr /><pre>";
        print_r($o->delete(['id' => 81]));
        die();
        
        
    }



}

<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Interfaces\Models\Auth;
use Aid\Model\Orders;
use Zend\Json\Server\Exception\BadMethodCallException;
use Zend\Json\Server\Server;
use Zend\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

class IndexController extends Base
{
    private $test = [];

	public function __construct(LoggerInterface $logger, Auth $apiAccess,Server $rpcServer, array $test = [])
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
	    $hash = $this->getHash();
		$checkAccess = $this->getApiAccess()->check($hash);

        if (empty($checkAccess) && ('POST' == $_SERVER['REQUEST_METHOD'])) {
            $this->getRpcServer()->fault("Access denied!", 403);
        } elseif (empty($checkAccess)) {
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

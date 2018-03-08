<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\JsonRpc\Moda;
use Aid\Model\Order\OrdersTable;
use Aid\Model\ApiAccess;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;

class IndexController extends AbstractActionController
{
	private $ordersTable;
	private $apiAccess;
    private $rpcServer;
	public function __construct(array $models, Server $server)
	{
		$this->ordersTable = $models['OrdersTable'];
		$this->apiAccess = $models['ApiAccess'];
		$this->rpcServer = $server;
	}

    public function onDispatch(MvcEvent $e)
    {
        //Преобразовываем в массив и передаем...
        $hash = str_split($this->params()->fromRoute('hash', ''));
        $checkAccess = $this->apiAccess->checkAccess($hash);
        
        if(!isset($checkAccess['id']))
        {
            echo "Access denied!";
            die();
        }

        return parent::onDispatch($e);
    }

    public function indexAction()
    {
        $this->run();
        exit();
    }


    private function run(){
        $server = $this->rpcServer;
        if ('GET' == $_SERVER['REQUEST_METHOD']) {
            $server->setTarget('/tests')
                ->setEnvelope(Smd::ENV_JSONRPC_2);
            $smd = $server->getServiceMap();
            $smd->setDojoCompatible(true);

            header('Content-Type: application/json');
            echo $smd;
            return;
        }
        $server->handle();
    }
}

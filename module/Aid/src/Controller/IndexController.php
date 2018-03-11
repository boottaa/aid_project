<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Model\ApiAccess;
use Zend\Log\Logger;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;

class IndexController extends AbstractActionController
{
	private $apiAccess;
    private $rpcOrders;
    private $rpcEmployees;

    /**
     * @var Logger
     */
    private $logger;

	public function __construct(ApiAccess $apiAccess, array $rpc)
	{
		$this->apiAccess = $apiAccess;
		$this->rpcOrders = $rpc["RpcOrder"];
		$this->rpcEmployees = $rpc["RpcEmployee"];
	}

    public function onDispatch(MvcEvent $e)
    {

        $this->logger = $this->PluginLogger()->getLogger();

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
        $this->run($this->rpcOrders);
        exit();
    }

    public function employeeAction()
    {
        $this->run($this->rpcEmployees);
        exit();
    }

    private function run(Server $server)
    {
        if ('GET' == $_SERVER['REQUEST_METHOD'])
        {
            $server->setTarget('/aid')
                ->setEnvelope(Smd::ENV_JSONRPC_2);
            $smd = $server->getServiceMap();
            $smd->setDojoCompatible(true);

            header('Content-Type: application/json');
            echo $smd;
            return;
        }
        $server->handle();
        $this->logger->info("REQUEST: ".$server->getRequest()." RESPONSE: ".$server->getResponse());

    }

}

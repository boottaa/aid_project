<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\JsonRpc\Employees;
use Aid\JsonRpc\Moda;
use Aid\Model\Order\OrdersTable;
use Aid\Model\ApiAccess;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;

class IndexController extends AbstractActionController
{
	private $apiAccess;
    private $rpcOrders;
    private $rpcEmployees;
	public function __construct(ApiAccess $apiAccess, array $rpc)
	{
		$this->apiAccess = $apiAccess;
		$this->rpcOrders = $rpc["RpcOrder"];
		$this->rpcEmployees = $rpc["RpcEmployee"];
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
        $this->run($this->rpcOrders);
        exit();
    }

    public function employeeAction()
    {
        $this->run($this->rpcEmployees);
        exit();
    }

//    public function teAction()
//    {
//        $data['data'] = [
//            'lname' => 'AAA',
//            'fname' => 'FFF',
//            'email' => 'asd@asd.com',
//            'password' => md5('das21312asd')
//        ];
//
//        $employee = new \Aid\Model\Employee\Employees();
//
//        $filter = $employee->getInputFilter();
//
//        $filter->setData($data);
//
//
//
//        if($filter->isValid())
//        {
//            $employee->exchangeArray($data);
//            $this->employeesTable->saveEmployee($employee);
//
//            return true;
//        }else{
//            return "Error: not valid data";
//        }
//    }

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

//        file_put_contents(__DIR__.'/../../../../logs/Aid/rpcserver.log', date("d-m-Y H:i:s")." || request ".$server->getRequest()." || response ".$server->getResponse().PHP_EOL, FILE_APPEND);
    }

}

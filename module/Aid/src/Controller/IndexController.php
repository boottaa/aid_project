<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\JsonRpc\Calculator;
use Aid\JsonRpc\Orders;
use Aid\Model\Order\OrdersTable;
use Interop\Container\ContainerInterface;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;

class IndexController extends AbstractActionController
{
	private $ordersTable;
	public function __construct(OrdersTable $order)
	{
		$this->ordersTable = $order;
	}


	public function indexAction()
    {

    	$data = [
		    'hello' => 1,
		    'hello2' => 2,
		    'hello3' => 3,
	    ];
    	$jsonData = Json::encode($data);
		$view = new ViewModel();
		$view->setVariable('data', $jsonData);

    	return $view;
    }

	public function clientAction()
	{

		//die("http://{$_SERVER['HTTP_HOST']}/analytic");

		$client = new \Zend\Json\Server\Client("http://{$_SERVER['HTTP_HOST']}/aid/tests");

		$client->call( 'getOrder', [4] );

		$res = $client->getLastResponse()->getResult();

		/////////////////DEBUG///////////////////////////
		echo "<div style='background: #000; padding: 10px; color: #00e300;'><b style='color: red;'>"
			.__FILE__
			."</b><hr style='border: solid 2px blue;width: 100%;' /><pre>";
		print_r($res);
		echo "</div>";
		die();
		//////////////////////DEBUG//////////////////////
		die();
	}



	public function testsAction()
    {
	    $orderTable = $this->ordersTable;
    	$jsonOrders = new Orders($orderTable);
	    $server = new Server();

	    $server->setClass($jsonOrders);

	    if ('GET' == $_SERVER['REQUEST_METHOD']) {
		    $server->setTarget('/tests')
			    ->setEnvelope(Smd::ENV_JSONRPC_2);
		    $smd = $server->getServiceMap();

		    // Set Dojo compatibility:
		    $smd->setDojoCompatible(true);

		    header('Content-Type: application/json');
		    echo $smd;
		    return;
	    }

	    $server->handle();
    }


}

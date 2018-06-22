<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace RpcTest\Controller;

use Aid\JsonRpc\Calculator;
use Aid\JsonRpc\Orders;
use Aid\Model\Order\OrdersTable;
use Aid\Model\ApiAccess;
use Interop\Container\ContainerInterface;
use Zend\Json\Json;
use Zend\Json\Server\Error;
use Zend\Json\Server\Exception\ErrorException;
use Zend\Json\Server\Exception\InvalidArgumentException;
use Zend\Json\Server\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

use Zend\View\Model\ViewModel;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $dataE['data'] = [
            'lname' => 'AAA',
            'fname' => 'FFF',
            'email' => 'asd@asd.com',
            'password' => md5('das21312asd'),
//            'profession' => 'asdsd',
            'rating'    => 100,
        ];

        $this->sendRequest($dataE);
    }

    public function professionsAction()
    {
        //addProfession
        $data['data'] = [
            'title' => 'БОГ'
        ];

        //addProfessionToEmployee
        $data['data'] = [
            'id_employee' => 1,
            'id_profession' => 1,
            'price' => 100,
            'experience' => '1 год',
            'description' => "HAHAHAH"
        ];

        //getProfessionToEmployee
        $data['data'] = [
            'id' => 1
        ];

        $this->sendRequest(['data' => ['id_employee' => 1]], 'professions', 'getProfessionToEmployee', true);
    }




    public function sendRequest(array $data, $action = 'employees', $method = 'add', $debug = true)
    {
        $hash = $this->params()->fromRoute('hash', '');
        $client = new \Zend\Json\Server\Client("http://{$_SERVER['HTTP_HOST']}/aid/".$hash."/".$action);

        try
        {
            $e = $client->call( $method, $data);
        }
        catch (ErrorException $e)
        {
            $e = $client->getLastResponse()->getError();
        }

        if ($debug){
            echo "<div style='background: #000; padding: 10px; color: #00e300;'><b style='color: red;'>"
                .__FILE__.' action: '.$action.' method: '.$method
                ."</b><hr style='border: solid 2px blue;width: 100%;' /><pre>";
            print_r($e);
            echo "</div>";
        }

        die();
    }
}

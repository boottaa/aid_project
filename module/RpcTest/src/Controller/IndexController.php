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
        $hash = $this->params()->fromRoute('hash', '');
//        echo "<pre>";
//        print_r($hash);
//        die("***DIE***");
        $client = new \Zend\Json\Server\Client("http://{$_SERVER['HTTP_HOST']}/aid/".$hash."/employee");

        $data['data'] = [
            "id_order" => "6",
//            "status"  => '1',
//            "address" => "asddddd",
//            "phone"   => 1111222,
//            'email'   => "boo@dd.cc"
        ];

        $dataE['data'] = [
            'lname' => 'AAA',
            'fname' => 'FFF',
            'email' => 'asd@asd.com',
            'password' => md5('das21312asd'),
//            'profession' => 'asdsd',
            'rating'    => 100,
        ];

        $client->call( 'saveEmployee', $dataE );

        $e = $client->getLastResponse()->getError();

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







}

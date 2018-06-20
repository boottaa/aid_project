<?php
namespace Test\Controller;

use Zend\Json\Server\Exception\ErrorException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function sendRequest(array $data, $action = 'employees', $method = 'add', $hash, $debug = true)
    {
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


    public function indexAction()
    {
        return new ViewModel();
    }

    public function handlersAction()
    {
        $request = $this->getRequest();
        if($request->isPost()){

            $class = strtolower($request->getPost('class', null));
            $methods = $request->getPost('method', null);
            @$action = end(explode('\\', $class));

            $this->sendRequest();
        }
        

        $classes = [
            \Aid\JsonRpc\ClassHandlers\Employees::class => [],
            \Aid\JsonRpc\ClassHandlers\Orders::class => [],
            \Aid\JsonRpc\ClassHandlers\Professions::class => []
        ];

        $r = [];
        foreach ($classes as $c => $v){
            $methods = get_class_methods($c);


            @$smGetClass = strtolower(end(explode('\\', $c)));


            array_walk($methods, function($value, $key) use (&$r, $c)
            {
                if($value == '__construct') return;
                $r[$c][] = $value;
            });
        }

        return new ViewModel(['items' => $r]);
    }


    public function modelsAction()
    {
        return new ViewModel();
    }
}

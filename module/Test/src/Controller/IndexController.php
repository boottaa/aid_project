<?php
namespace Test\Controller;

use Test\DataForTesting\ClassHandlers;
use Zend\Json\Server\Exception\ErrorException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{

    public function onDispatch(MvcEvent $e)
    {
        session_start();
        return parent::onDispatch($e); // TODO: Change the autogenerated stub
    }



    public function sendRequest(array $data, $action, $method, $hash)
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

        if(preg_match('/add(\w)?/m',$method)){
            $_SESSION[$action][$method] = $e;
        }

        return $e;
    }


    public function indexAction()
    {
        return new ViewModel();
    }

    public function handlersAction()
    {
        $postData = [];
        $request = $this->getRequest();
        if($request->isPost()){

            $class = strtolower($request->getPost('class', null));
            $methods = $request->getPost('method', null);
            @$action = end(explode('\\', $class));

            $data = ClassHandlers::data($action, $methods);

            if (!empty($data)) {
                $postData = $this->sendRequest($data, $action, $methods, ClassHandlers::HASH);
            }else{
                throw new \Exception("Ошибка: для класса: ".$action." метод: ".$methods." не удалось найти данные");
            }
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
                if($value == '__construct' || $value == 'getJsonRpcServer') return;
                $r[$c][] = $value;
            });
        }

        return new ViewModel(['items' => $r, 'postData' => $postData]);
    }

}

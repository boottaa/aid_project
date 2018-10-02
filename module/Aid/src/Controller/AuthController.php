<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Helpers\Auth\Base64;
use Aid\Interfaces\Models\Auth;
use Aid\Model\Users;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;
use Zend\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

class AuthController extends Base
{
    use Base64;
    private $users;

	public function __construct(
	    LoggerInterface $logger,
        Auth $apiAccess,
        Server $rpcServer,
        //Пока оставим кеш на продакшене пока не работает нужно разобраться
        AbstractAdapter $cache,
        Users $users,
        $isDebug = false
    )
	{
		$this->setLogger($logger);
		$this->setApiAccess($apiAccess);
		$this->setRpcServer($rpcServer);
        $this->isDebug = $isDebug;
        $this->users = $users;
	}

	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		return parent::onDispatch($e);
	}

    public function acceptAction(){

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        if(!empty($id) && $id > 0){
            $user = $this->users->getOnly(['id' => $id]);

            $hash = $this->getHash();
            if($user['password'] == $hash){
                $user['status'] = 1;
                $this->users->exchangeArray($user)->save();
                echo "Молодец, регистрацию завершил";
            }else{
                echo "Хакер что ли?";
            }
        }else{
            echo "Как ты сюда попал?";
        }

        exit();
    }

	/**
     * @inheritdoc: aid/k/auth/users
     */
	public function indexAction()
    {
        $this->getRpcServer()->getFunctions()->removeMethod('getItem');
        $this->getRpcServer()->getFunctions()->removeMethod('fethList');
        $this->getRpcServer()->getFunctions()->removeMethod('add');
        $this->getRpcServer()->getFunctions()->removeMethod('delete');

        $this->run('auth');
    }

//    public function restoreAction()
//    {
//        $hash = $this->getHash();
//        $id = $this->getEvent()->getRouteMatch()->getParam('id');
//
//
//        try {
//            $hashDecode = $this->decode($hash);
//            list($email, $time) = explode("__", $hashDecode);
//
//            if ($time < time()) {
//                echo "сcылка устарела";
//                die();
//            }
//            if($this->getRequest()->isPost()) {
//                $user = iterator_to_array($this->users->getOnly(['email' => $email, 'id' => $id]));
//                $user['password'] = substr($hash, 0, 8);
//                $this->users->exchangeArray($user);
//            }
//        }catch (\Exception $e){
//
//        }
////        echo "Извините востановить пароль временно не возможно!!!".$this->base64_url_decode($hash).$id;
//        exit();
//    }

    protected function run($class, $userIp = '', $hash = '', $method = '')
    {
        $server = $this->getRpcServer();

        try
        {
            if ('GET' == $_SERVER['REQUEST_METHOD'])
            {
                $server->setTarget('/aid/'.$class)
                    ->setEnvelope(Smd::ENV_JSONRPC_2);
                $smd = $server->getServiceMap();
                $smd->setDojoCompatible(true);
                
                header('Content-Type: application/json');
                echo "{\"methods\":[".$smd->getService('auth').",".$smd->getService('registration')."]}";

                exit();
            }

            $server->handle();

            $this->getLogger()->debug("Request: " . $server->getRequest()->toJson());
            $this->getLogger()->debug("Response: " . $server->getResponse()->toJson());

            exit();
        }
        catch (\Exception $e)
        {
            $this->getLogger()->err($e->getMessage());
        }
    }
	

}

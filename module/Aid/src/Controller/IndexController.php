<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller;

use Aid\Interfaces\Models\Auth;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\Json\Server\Exception\BadMethodCallException;
use Zend\Json\Server\Server;
use Zend\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

class IndexController extends Base
{
	public function __construct(
	    LoggerInterface $logger,
        Auth $apiAccess,
        Server $rpcServer,

        //Пока оставим кеш на продакшене пока не работает нужно разобраться
        AbstractAdapter $cache,

        $isDebug = false
    )
	{
		$this->setLogger($logger);
		$this->setApiAccess($apiAccess);
		$this->setRpcServer($rpcServer);
        $this->isDebug = $isDebug;
	}

	/**
	 * @param MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e)
	{
		return parent::onDispatch($e);
	}

	/**
     * @inheritdoc: aid/k/auth/users
     */
	public function authAction()
    {
        $class = 'auth';

        $this->run($class);
    }
	

	/**
     * @inheritdoc: /aid/k33f3c8db70d437ce41cfbd1bbde0f413/run/orders (model name)
	 */
    public function runAction()
    {
        $userIp = (new RemoteAddress())->getIpAddress();
        $hash = $this->getHash();
        $class = $this->params()->fromRoute('model', '');
        $method = $this->getRpcServer()->getRequest()->getMethod();

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $checkAccess = $this->getApiAccess()->check($userIp, $hash, $class, $method);
            if (!$checkAccess) {
                 $this->getRpcServer()->fault("Access denied!", 403);
//                throw new BadMethodCallException("Access denied!");
            }

        }elseif ('GET' == $_SERVER['REQUEST_METHOD']){
            // Для безопасности только get пропускаем все остальное в топку
        }else{
            $this->getLogger()->err("BAD REQUEST");
            throw new BadMethodCallException("BAD REQUEST");
        }

        $this->run($class, $userIp, $hash, $method);
    }
}

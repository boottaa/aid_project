<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 03.04.18
 * Time: 11:21
 */

namespace Aid\Controller;


use Aid\Interfaces\Models\Auth;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Log\LoggerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;
use Zend\Log\Logger;

/**
 * Class Base - Наследуемся от данного класса для создания контролеров
 * @package Aid\Controller
 */

class Base extends AbstractActionController
{
	/**
	 * @var Logger
	 */
	private $logger;
	/**
	 * @var Auth
	 */
	private $apiAccess;
	/**
	 * @var Server
	 */
	private $rpcServer;
    /**
     * @var AbstractAdapter
     */
	private $cache;

    /**
     * @param AbstractAdapter $cache
     */
    public function setCache(AbstractAdapter $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return AbstractAdapter
     */
    public function getCache()
    {
        return $this->cache;
    }

	/**
	 * @return Server
	 */
	public function getRpcServer()
	{
		return $this->rpcServer;
	}

	/**
	 * @param Server $rpcServer
	 */
	public function setRpcServer(Server $rpcServer)
	{
		$this->rpcServer = $rpcServer;
	}

	/**
	 * @return Logger
	 */
	public function getLogger()
	{
		return $this->logger;
	}

	/**
	 * @param Logger $logger
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * @return Auth
	 */
	public function getApiAccess()
	{
		return $this->apiAccess;
	}

    /**
     * @param Auth $apiAccess
     */
    public function setApiAccess(Auth $apiAccess)
    {
        $this->apiAccess = $apiAccess;
    }

    /**
     * Get hash without k (first)
     *
     * @return string
     */
	public function getHash()
    {
        $hash = $this->params()->fromRoute('hash', '');
        $hash = str_split($hash);
        unset($hash[0]);
        return implode("", $hash);
    }



	/**
	 * @param Server $server
	 */
	protected function run($userIp, $hash, $class, $method)
	{
		$server = $this->getRpcServer();
		try
		{
			if ('GET' == $_SERVER['REQUEST_METHOD'])
			{
				$server->setTarget('/aid/key/run/'.$class)
					->setEnvelope(Smd::ENV_JSONRPC_2);
				$smd = $server->getServiceMap();
				$smd->setDojoCompatible(true);

				header('Content-Type: application/json');
				echo $smd;
				exit();
			}
            $haskForCache = md5($method.' '.$class.' '.serialize($server->getRequest()->getParams()));

            if ($this->getCache()->hasItem($haskForCache) && $method != 'add') {
                echo $this->getCache()->getItem($haskForCache);
            } else {
                $server->handle();
                $this->getCache()->addItem($haskForCache, $server->getResponse());
            }

//            $server->handle();

//			echo $server->getRequest();
//			$hashRequest = md5($class.$method);
//            echo json_encode($hashRequest);

//			if($this->getCache()->hasItem($hashRequest)){
			    //Если есть в кеше то выводим
//			    echo $this->getCache()->getItem($hashRequest);
//            }else{
//                $server->handle();
//                $this->getCache()->addItem($hashRequest, $server->getResponse());
//            }

//			$this->getLogger()->debug("REQUEST: ".$server->getRequest()." RESPONSE: ".$server->getResponse());
		}
		catch (\Exception $e)
		{
			$this->getLogger()->err($e->getMessage());
		}
		exit();
	}
}
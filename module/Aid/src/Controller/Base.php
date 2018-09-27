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
use Zend\Json\Server\Exception\InvalidArgumentException;
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
     * @isDebug from config/autoload/global.php
     */
    public $isDebug;

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
     * @param $class
     * @param string $userIp
     * @param string $hash
     * @param string $method
     */
	protected function run($class, $userIp = '', $hash = '', $method = '')
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
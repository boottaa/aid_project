<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 03.04.18
 * Time: 11:21
 */

namespace Aid\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\Json\Server\Server;
use Zend\Json\Server\Smd;
use Aid\Model\ApiAccess;
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
	 * @var ApiAccess
	 */
	private $apiAccess;
	/**
	 * @var Server
	 */
	private $rpcServer;

	//Если ошибки пишем сюда.
	private $error = null;


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
	public function setLogger(Logger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * @return ApiAccess
	 */
	public function getApiAccess()
	{
		return $this->apiAccess;
	}

	/**
	 * @param ApiAccess $apiAccess
	 */
	public function setApiAccess(ApiAccess $apiAccess)
	{
		$this->apiAccess = $apiAccess;
	}

	/**
	 * @param Server $server
	 */
	protected function run()
	{
		$server = $this->getRpcServer();
		try
		{
			if ('GET' == $_SERVER['REQUEST_METHOD'])
			{
				$server->setTarget('/aid')
					->setEnvelope(Smd::ENV_JSONRPC_2);
				$smd = $server->getServiceMap();
				$smd->setDojoCompatible(true);

				header('Content-Type: application/json');
				echo $smd;
				exit();
			}

			//Если есть ошибки в запросе то выводим их.
			if (!empty($this->error))
			{
				$server->fault(
					$this->error['message'],
					$this->error['code'],
					$this->error['data']
				);
			}
			$server->handle();
			$this->logger->info("REQUEST: ".$server->getRequest()." RESPONSE: ".$server->getResponse());
		}
		catch (\Exception $e)
		{
			$this->logger->err($e->getMessage());
		}
		exit();
	}

	/**
	 * @param null $message
	 * @param int $code
	 * @param null $data
	 */
	protected function error($message = null, $code = 404, $data = null)
	{
		$this->error['message'] = $message;
		$this->error['code'] = $code;
		$this->error['data'] = $data;
	}

}
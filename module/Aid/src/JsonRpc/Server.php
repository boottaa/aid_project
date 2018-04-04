<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 04.04.18
 * Time: 17:07
 */

namespace Aid\JsonRpc;


use Zend\Json\Server\Error;

class Server extends \Zend\Json\Server\Server
{
	//Если ошибки пишем сюда true.
	private $error = false;

	public function handle($request = false)
	{

		if ($request) {
			$this->setRequest($request);
		}

		if($this->errorStatus() == false){
			// Handle request
			$this->handleRequest();
		}

		// Get response
		$response = $this->getReadyResponse();

		// Emit response?
		if (! $this->returnResponse) {
			echo $response;
			return;
		}

		// or return it?
		return $response;
	}

	/**
	 * @param null $fault
	 * @param int $code
	 * @param null $data
	 * @return Error
	 */
	public function fault($fault = null, $code = 404, $data = null)
	{
		$this->error = true;
		$error = new Error($fault, $code, $data);
		$this->getResponse()->setError($error);
		return $error;
	}

	public function errorStatus()
	{
		return $this->error;
	}
}
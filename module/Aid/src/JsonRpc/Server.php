<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 04.04.18
 * Time: 17:07
 */

namespace Aid\JsonRpc;


use Zend\Json\Server\Error;
use Zend\Json\Server\Request;
use Zend\Json\Server\Exception;
use Zend\Json\Server\Response;

/**
 * Handle request.
 *
 * @param  Request $request
 * @return null|Response
 * @throws Exception\InvalidArgumentException
 */

class Server extends \Zend\Json\Server\Server
{
	//Если ошибки пишем сюда true.
	private $error = false;

	public function handle($request = false)
	{
		if ((false !== $request) && ! $request instanceof Request) {
			throw new Exception\InvalidArgumentException('Invalid request type provided; cannot handle');
		}
		if ($request) {
			$this->setRequest($request);
		}
		if($this->isError() == false){
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
		parent::fault($fault = null, $code = 404, $data = null);
	}

	public function isError()
	{
		return $this->error;
	}
}
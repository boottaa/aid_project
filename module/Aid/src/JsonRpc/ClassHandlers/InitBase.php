<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc\ClassHandlers;

use Aid\Interfaces\Models\All;
use Aid\JsonRpc\Server;

class InitBase extends Base
{
    /**
     * Main constructor.
     *
     * @param All $model
     *
     * @return Server
     */
	public function init(All $model)
	{
        return $this->setModel($model)->getJsonRpcServer();
	}
}
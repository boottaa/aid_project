<?php
namespace Aid\JsonRpc;

use Aid\Model\ApiAccess;
use Zend\Json\Server\Exception\ErrorException;

/**
 * @property \Aid\Model\Users model
 */
class Users extends Base
{
    public function userInfo(int $id)
    {

        try {
            $requestUri = $this->getRequestUri();

            $hash = $requestUri['hash'];

            /**
             * @var ApiAccess $apiAccess ;
             */
            $apiAccess = $this->model->getApiAccess()->getOnly(['hash' => $hash, 'status' => '1', 'is_deleted' => '0']);
            if ($apiAccess['id_user'] == $id) {
                $result = parent::getItem(['id' => $id]);
                unset($result['password'], $result['date_update'], $result['is_deleted']);
            } else {
                throw new ErrorException("Access denied!");
            }

            return $result;
        } catch (\Exception $e) {
            throw new ErrorException("Access denied!");
        }
    }

    public function getItem(array $where)
    {
        throw new ErrorException("Access denied!");
    }

    public function fethList(int $page, int $limit, int $status = 1)
    {
        throw new ErrorException("Access denied!");
    }

    public function delete(array $where)
    {
        throw new ErrorException("Access denied!");
    }

}
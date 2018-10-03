<?php
namespace Aid\JsonRpc;

use Aid\Model\ApiAccess;
use League\Flysystem\Exception;
use Zend\Json\Server\Exception\ErrorException;

/**
 * @property \Aid\Model\Users model
 */
class Users extends Base
{
    /**
     * @param int $id
     *
     * @return bool
     */
    protected function checkAccess(int $id)
    {
        try {
            $requestUri = $this->getRequestUri();

            $hash = $requestUri['hash'];

            /**
             * @var ApiAccess $apiAccess ;
             */
            $apiAccess = $this->model->getApiAccess()->getOnly(['hash' => $hash, 'status' => '1', 'is_deleted' => '0']);
            if ($apiAccess['id_user'] == $id) {
                return true;
            }

            return false;
        } catch (Exception $e) {

            return false;
        }
    }

    public function info(int $id)
    {

        try {

            if ($this->checkAccess($id)) {
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

    public function update(int $id, $data)
    {
        if ($this->checkAccess($id)) {
            $data['id'] = $id;
            unset($data['password'], $data['date_update'], $data['is_deleted'], $data['status']);
            $userRow = iterator_to_array(parent::getItem(['id' => $id]));

            return parent::add(array_merge($userRow, $data));
        } else {
            throw new ErrorException("Access denied!");
        }
    }

    public function add(array $data)
    {
        throw new ErrorException("Access denied!");
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
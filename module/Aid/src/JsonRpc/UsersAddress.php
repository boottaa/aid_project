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
    public function add(array $data)
    {
        $data['id_user'] = $this->model->getApiAccess()->hashToUserId();
        parent::add($data);
    }

    public function getItem(array $where)
    {
        $where['id_user'] = $this->model->getApiAccess()->hashToUserId();
        parent::getItem($where);
    }

    public function fethList(int $page, int $limit, array $where = [])
    {
        $where['id_user'] = $this->model->getApiAccess()->hashToUserId();
        parent::fethList($page, $limit, $where);
    }

    public function delete(array $where)
    {
        $where['id_user'] = $this->model->getApiAccess()->hashToUserId();
        parent::delete($where);
    }

}
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

    public function info(int $id)
    {

        try {

            if ($this->model->getApiAccess()->checkAccess($id)) {
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
        if ($this->model->getApiAccess()->checkAccess($id)) {
            $data['id'] = $id;
            unset($data['password'], $data['date_update'], $data['is_deleted'], $data['status']);
            $userRow = iterator_to_array(parent::getItem(['id' => $id]));

            return parent::add(array_merge($userRow, $data));
        } else {
            throw new ErrorException("Access denied!");
        }
    }

    public function getAddress($page, $limit = 10, $where = [] )
    {
        $where['id_user'] = $this->model->getApiAccess()->hashToUserId();
        $r = $this->model->getAddress()->fetchAll($where);
        $r->setCurrentPageNumber($page);
        // set the number of items per page to 10
        $r->setItemCountPerPage($limit);

        $x = [];
        $x['getPages'] = $r->getPages();

        foreach ($r as $v)
        {
            $x['items'][] = $v;
        }

        return $x;
    }

    public function getProfessions($page, $limit = 10, $where = [] )
    {
        $where['id_user'] = $this->model->getApiAccess()->hashToUserId();
        $r = $this->model->getProfessions()->fetchAll($where);
        $r->setCurrentPageNumber($page);
        // set the number of items per page to 10
        $r->setItemCountPerPage($limit);

        $x = [];
        $x['getPages'] = $r->getPages();

        foreach ($r as $v)
        {
            $x['items'][] = $v;
        }

        return $x;
    }

    public function add(array $data)
    {
        throw new ErrorException("Access denied!");
    }

    public function getItem(array $where)
    {
        throw new ErrorException("Access denied!");
    }

    public function fethList(int $page, int $limit, array $where = [])
    {
        throw new ErrorException("Access denied!");
    }

    public function delete(array $where)
    {
        throw new ErrorException("Access denied!");
    }

}
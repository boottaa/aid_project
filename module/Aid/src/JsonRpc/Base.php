<?php
namespace Aid\JsonRpc;

use Aid\Interfaces\JsonRpc\InterfaceJsonRpc;
use Aid\Interfaces\Models\All;
use Aid\JsonRpc\Server;
use Zend\Json\Exception\InvalidArgumentException;
use Zend\Json\Server\Error;
use Zend\Json\Server\Exception\ErrorException;

class Base implements InterfaceJsonRpc
{
    /**
     * @var All
     */
    private $model;

    /**
     * @param All $model
     */
    public function __construct(All $model){
        $this->model = $model;
    }

    /**
     * @param array $where
     *
     * @return mixed
     */
    public function getItem(array $where)
    {
        try {
            return $this->model->getOnly($where);
        } catch (\Throwable $e) {
            throw new InvalidArgumentException("ERROR " . $e->getMessage(), Error::ERROR_INVALID_PARAMS);
        }
    }

    /**
     * @param int $page
     * @param int $limit
     * @param int $status
     *
     * @return array
     */
    public function fethList(int $page, int $limit, int $status = 1)
    {
        $r = $this->model->fetchAll(['status' => $status]);
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

    /**
     * if id iseet updated row
     *
     * @param array $data
     */
    public function add(array $data)
    {
        try {
            return $this->model->exchangeArray($data)->save();
        }catch (\Exception $e){
            throw new InvalidArgumentException("ERROR " . $e->getMessage(), Error::ERROR_INVALID_PARAMS);
        }
    }

    /**
     * @param array $where
     *
     * @return int
     */
    public function delete(array $where)
    {
         return $this->model->delete($where);
    }

}
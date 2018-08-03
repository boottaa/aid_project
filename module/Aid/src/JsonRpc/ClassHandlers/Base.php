<?php
namespace Aid\JsonRpc\ClassHandlers;

use Aid\Interfaces\JsonRpc\InterfaceJsonRpc;
use Aid\Interfaces\Models\All;
use Aid\JsonRpc\Server;
use Zend\Json\Server\Exception\ErrorException;

abstract class Base implements InterfaceJsonRpc
{
    /**
     * @var All
     */
    private $model;

    /**
     * @param All $model
     *
     * @return Server
     */
    protected function init(All $model){
        $this->model = $model;
        $server = new Server();
        $server->setClass($this);
        return $server;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getItem(int $id){
        try{
            return $this->model->getOnly(['id' => $id]);
        }catch (\Exception $e){
            throw new ErrorException("Error: not found order with id: ".$id);
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
        $r = $this->model->fetchAll($status);
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
            $this->model->exchangeArray($data)->save();
        }catch (\Exception $e){
//            $this->fault($e->getMessage(), 500);
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
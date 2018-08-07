<?php
namespace Aid\JsonRpc\ClassHandlers;

use Aid\Interfaces\JsonRpc\InterfaceJsonRpc;
use Aid\Interfaces\Models\All;
use Aid\JsonRpc\Server;
use Zend\Json\Server\Exception\ErrorException;

class Base implements InterfaceJsonRpc
{
    /**
     * @var All
     */
    private $model;

    /**
     * @var Server
     */
    private $server;

    /**
     * @param All $model
     *
     * @return Server
     */
    public function __construct(All $model){
        $this->model = $model;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getItem(int $id){
        try{
            return $this->model->getOnly(['id' => $id]);
        }catch (\Throwable $e){
            $this->server->fault($e->getMessage());
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
            return $this->model->exchangeArray($data)->save();
        }catch (\Exception $e){
            $this->server->fault($e->getMessage(), 500);
        }

        return 0;
    }

    /**
     * @param array $where
     *
     * @return int
     */
    public function delete(array $data)
    {
         return $this->model->delete($data);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 01.06.18
 * Time: 17:35
 */
namespace Test\Model\_Interface;

interface BaseTable
{
    /**
     * Return allRows
     *
     * @param array $where
     *
     * @return mixed
     */
    public function all(array $where = ['is_deleted' => '0']);

    /**
     * return only where
     *
     * @param array|null $where
     *
     * @return mixed
     */
    public function item(array $where = null);

    /**
     * Save data in data base
     *
     * @param array $data
     *
     * @return mixed
     */
    public function save(array $data);

    /**
     * delete data in data base
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id);
}
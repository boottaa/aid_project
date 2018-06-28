<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 08.03.2018
 * Time: 12:37
 */

namespace Aid\Model;


use Zend\Db\Sql\Sql;

class ApiAccess
{
    private $sql;
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }

    public function checkAccess(array $hash)
    {
        //Удаляем первый символ
        unset($hash[0]);
        //Получаем массив символов и приобразуем его в строку.
        $hash = implode("", $hash);
        
        $select = $this->sql
            ->select()
            ->where(['hash' => $hash]);
        
        return $this->sql->prepareStatementForSqlObject($select)->execute()->current();
    }
}
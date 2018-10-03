<?php
namespace Aid\JsonRpc;

use Aid\Model\ApiAccess;
use Zend\Json\Server\Exception\ErrorException;


/**
 * @property \Aid\Model\Users  model
 */
class Users extends Base
{
    public function auth($email, $password)
    {
        /**
         * @var ApiAccess $apiAccess;
         */
        $apiAccess = $this->model->getApiAccess();
        $pass = $this->model->hashPassword($password);

        $where = [
            'email' => $email,
            'password' => $pass,
        ];

        try{
            $result = parent::getItem($where); // TODO: Change the autogenerated stub
            if(
                !empty($result['email']) &&
                isset($result['status']) &&
                $result['status'] == 1 &&
                isset($result['is_deleted']) &&
                $result['is_deleted'] == 0
            ){
                $hash = md5(serialize($result)."SALAID");

                try {
                    $apiRow = iterator_to_array($apiAccess->getOnly(['hash' => $hash]));

                    if($apiRow['status'] != 1){
                        $apiRow['status'] = $result['status'];
                        $apiAccess
                            ->exchangeArray($apiRow)
                            ->save();
                    }

                } catch (\Exception $e) {

                    $apiAccess->exchangeArray([
                        'hash' => $hash,
                        'id_user' => $result['id'],
                        'type' => $result['type'],
                        'status' => $result['status'],
                    ])->save();

                }

                unset($result['password'], $result['date_update'], $result['is_deleted']);
                $result['hash'] = $hash;
                return $result;
            }

            return false;

        }catch (\Exception $e){
            if($this->isDebug == true){
                $this->logger->debug(
                    'class: ' . __CLASS__ . ' method: ' . __METHOD__ . ' message: ' . $e->getMessage().' getFile:'. $e->getFile().' getLine:'. $e->getLine()
                );
            }
            return false;
        }
    }

    public function getItem(array $where)
    {
        $request = $this->getRequest();

        /**
         * @var ApiAccess $apiAccess;
         */

//        if($apiAccess = $this->model->getApiAccess()->check($request['user_ip'], $request['hash'], $request['class']))
//        $result = parent::getItem(['id' => $idUser]);
//        unset($result['password'], $result['date_update'], $result['is_deleted']);

        return $request; // TODO: Change the autogenerated stub
    }

}
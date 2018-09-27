<?php
namespace Aid\JsonRpc;

use Aid\Interfaces\JsonRpc\InterfaceJsonRpc;
use Aid\Model\ApiAccess;

class Users extends Base implements InterfaceJsonRpc
{
    public function auth($email, $password)
    {
        /**
         * @var ApiAccess $apiAccess;
         */
        $apiAccess = $this->model->getApiAccess();

        $where = [
            'email' => $email,
            'password' => $password
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
                $checkHash = $apiAccess->getOnly(['hash'=> $hash]);

                if (empty($checkHash['hash']) && empty($result['is_deleted']) && $checkHash['status'] == $result['status']) {
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
                    'class: ' . __CLASS__ . ' method: ' . __METHOD__ . ' message: ' . $e->getMessage()
                );
            }
            return false;
        }
    }
}
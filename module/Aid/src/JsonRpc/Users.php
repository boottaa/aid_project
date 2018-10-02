<?php
namespace Aid\JsonRpc;

use Aid\Helpers\Auth\Base64;
use Aid\Model\ApiAccess;
use Zend\Json\Server\Exception\ErrorException;


/**
 * @property \Aid\Model\Users  model
 */
class Users extends Base
{
    use Base64;

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

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function registration(array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = $this->model->hashPassword($data['password']);
        }

        $hash = $data['password'];
        try{
            $r = iterator_to_array($this->model->getOnly(['email' => $data['email']]));
            $id = $r['id'];

            if(!empty($id)){
                if($this->isDebug == true){
                    $this->logger->debug(
                        'class: ' . __CLASS__ . ' method: ' . __METHOD__ . ' message: User exist, email:'.$data['email']
                    );
                }

                throw new ErrorException("Sorry: user with mail: ".$data['email']." exist");
            }
        }catch (ErrorException $err){
            return $err->getMessage();
        }catch (\Exception $e){
            $id = parent::add($data);
        }

        $link = "http://billig.ru/auth/accept/k{$hash}/{$id}";

        $to      = $data['email'];
        $subject = 'Подтверждение регистрации';
        $message = 'Для завершения регистрации перейдите по ссылке: '.$link;
        $headers = 'From: noreply@billig.ru' . "\r\n" .
            'Reply-To: noreply@billig.ru' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        return $id;// TODO: Change the autogenerated stub
    }

    /**
     * @param string $email
     */
    public function restorePassword(string $email){
        try{
            $user = iterator_to_array($this->model->getOnly(['email' => $email, 'status' => '1', 'is_deleted' => '0']));
            $hash = $this->base64_url_encode($email);
            $id = $user['id'];

            $link = "http://billig.ru/auth/restore/k{$hash}/{$id}";;

            $to      = $user['email'];
            $subject = 'Востановления доступа';
            $message = 'Для востановления пароля перейдите по ссылке: '.$link;
            $headers = 'From: noreply@billig.ru' . "\r\n" .
                'Reply-To: noreply@billig.ru' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            
            return "Check your mailbox: ".$email;

        }catch (\Exception $e){

            if($this->isDebug == true){
                $this->logger->debug(
                    'class: ' . __CLASS__ . ' method: ' . __METHOD__ . ' message: '.$e->getMessage()
                );
            }

            throw new ErrorException("Sorry: user with mail: ".$email."not exist");
        }
    }
}
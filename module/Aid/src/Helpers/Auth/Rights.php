<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 14.08.18
 * Time: 13:12
 */

namespace Aid\Helpers\Auth;

use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Permissions\Acl\Acl;

class Rights extends Acl
{
    function __construct(AbstractAdapter $cache)
    {
        $allow = include __DIR__ . '/allow.php';
        $users = array_keys($allow);
        foreach ($users as $user) {
            $this->addRole($user);

            $resursesAllow = $allow[$user];
            foreach ($resursesAllow as $resurse => $allows) {
                if (!$this->hasResource($resurse)) {
                    $this->addResource($resurse);
                }
                $this->allow($user, $resurse, $allows);
            }
        }
    }
}
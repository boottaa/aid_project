<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 14.08.18
 * Time: 13:12
 */

namespace Aid\Helpers\Auth;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Permissions\Acl\Role\GenericRole;

class Rights extends Acl
{


    function __construct()
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
        //--- --- --- --- --- --- --- --- --- --- --- --- --- ---//
        //$this need cached and get $this from cached if exists  //
    }   //--- --- --- --- --- --- --- --- --- --- --- --- --- ---//
}
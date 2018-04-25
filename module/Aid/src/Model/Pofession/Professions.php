<?php

/**
 * Created by PhpStorm.
 * User: boott
 * Date: 09.03.2018
 * Time: 15:08
 */
namespace Aid\Model\Pofession;

use Zend\InputFilter\InputFilter;

class Professions
{
    public $id_profession;
    public $title;
    public $date_create;
    public $is_deleted;


    public function exchangeArray($data)
    {
        $this->id_profession  = (!empty($data['id_profession'])) ? $data['id_profession'] : null;
	    $this->title          = (!empty($data['title'])) ? $data['title'] : null;
        $this->date_create    = (!empty($data['date_create'])) ? $data['date_create'] : null;
        $this->is_deleted     = (!empty($data['is_deleted'])) ? $data['is_deleted'] : '0';
    }
}
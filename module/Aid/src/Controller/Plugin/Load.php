<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 10.03.2018
 * Time: 21:35
 */

namespace Aid\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;


class Load extends AbstractPlugin
{

    /**
     * @var array
     */
    private $collection = [];

    /**
     * @param array
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function get($name)
    {
        if(in_array($name, $this->collection)){
            return new $this->collection[$name];
        }
    }


}
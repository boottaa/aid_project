<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 10.03.2018
 * Time: 21:35
 */

namespace Aid\Controller\Plugin;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class PluginLogger extends AbstractPlugin
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * PluginLogger constructor.
     * @param Logger $logger
     */
    public function __construct( $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }



}
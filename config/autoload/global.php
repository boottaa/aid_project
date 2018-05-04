<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Log\Writer\Stream;

return array(
	'db' => array(
		'driver'         => 'Pdo',
		'dsn'            => 'mysql:dbname=Aid;host=192.168.33.11',
		'username'       => 'bootta',
		'password'       => '1991',
		'driver_options' => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),

    'log' => [
        'writers' => array(
            //Можем добавить несколько стримов.
            ['name' => new Stream('./logs/Aid/rpcserver.log'),]
        ),
    ],
);
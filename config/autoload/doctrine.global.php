<?php
//config/autoload/doctrine.global.php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'weekit',
                ),
            ),
        ),

         'configuration' => array(
            'orm_antigo_bd' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'weekit',
                ),
            )
        ),
    ),
    'php_settings' => array(
        'date.timezone'                 => 'America/Bahia',
        'mbstring.internal_encoding'    => 'UTF-8',
    )
);
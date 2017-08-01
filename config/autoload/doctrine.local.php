<?php
//config/autoload/doctrine.global.php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'user'      => 'root',
                    'password'  => '12345',
                    'host'      => 'localhost',
                    'port'      => '3306',
                    'dbname'    => 'weekit',
                    'driverOptions' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    )

                ),
                'doctrine_type_mappings' => array(
                    'enum' => 'string'
                ),
            ),
        ),
        'configuration' => [
            'orm_default' => [
                'datetime_functions' => [
                    'date' =>            'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'time' =>            'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'timestamp' =>      'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'convert_tz' =>      'Oro\ORM\Query\AST\Functions\DateTime\ConvertTz',
                ],
                'numeric_functions' => [
                    'timestampdiff'  =>  'Oro\ORM\Query\AST\Functions\Numeric\TimestampDiff',
                    'dayofyear'  =>      'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'dayofmonth'  =>     'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'dayofweek'  =>      'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'week'  =>           'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'day'  =>            'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'hour'  =>           'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'minute'  =>         'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'month'  =>          'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'quarter'  =>        'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'second'  =>         'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'year'  =>           'Oro\ORM\Query\AST\Functions\SimpleFunction',
                    'sign'  =>           'Oro\ORM\Query\AST\Functions\Numeric\Sign',
                    'pow'  =>            'Oro\ORM\Query\AST\Functions\Numeric\Pow',
                ],
                'string_functions' => [
                    'group_concat' =>   'Oro\ORM\Query\AST\Functions\String\GroupConcat',
                    'cast' =>           'Oro\ORM\Query\AST\Functions\Cast',
                    'concat_ws' => 'Oro\ORM\Query\AST\Functions\String\ConcatWs'
                ]
            ]
        ]
    ),
);
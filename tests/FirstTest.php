<?php
namespace ParagonIE\EasyDB\Tests;

use ParagonIE\EasyDB\EasyDB;
use ParagonIE\EasyDB\Factory;
use PDO;
use PDOException;

class FirstTest
    extends
        ColumnTest
{

    protected function GoodColArguments()
    {
        return [
            [
                'SELECT 1 AS foo', 0, [], [1]
            ],
            [
                'SELECT 1 AS foo, 2 AS bar', 0, [], [1]
            ],
            [
                'SELECT 1 AS foo, 2 AS bar UNION SELECT 3 AS foo, 4 AS bar', 0, [], [1,3]
            ],
            [
                'SELECT ? AS foo, ? AS bar UNION SELECT ? AS foo, ? AS bar', 0, [1, 2, 3, 4], [1, 3]
            ],
        ];
    }


    protected function getResultForMethod(EasyDB $db, $statement, $offset, $params)
    {
        $args = $params;
        array_unshift($args, $statement);

        return call_user_func_array([$db, 'first'], $args);
    }
}
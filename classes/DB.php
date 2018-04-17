<?php
/**
 * Created by PhpStorm.
 * User: jackob
 * Date: 2018/3/27
 * Time: 上午2:06
 */
class DB {

    private static function connect() {
        $pdo = new PDO('mysql:host=127.0.0.1; dbname=YP; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 04/11/2019
 */

class database
{
    public static function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=daily_trends;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
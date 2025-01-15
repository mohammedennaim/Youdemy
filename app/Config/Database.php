<?php
namespace App\Config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database{
    public static $conn;

    public static function connection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__."/../../");
        $dotenv->load();
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=".$_ENV["LOCALHOST"].";dbname=".$_ENV["DATABASE"],$_ENV["USER"],$_ENV["USER_PASSWORD"]);
                return self::$conn;
            } catch (PDOException $e) {
                die("connection faild".$e-->getMessage());
            }
        }
        return self::$conn;
    }
}

?>
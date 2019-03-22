<?php
require __DIR__ . '/../../vendor/autoload.php';




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
]];
$app = new \Slim\App($config);
date_default_timezone_set('UTC');


class DB
{
    
    private $host = 'db4free.net';
    private $MySqlUsername = 'smartcity4u';
    private $MySqlPassword = '23243125';
    private $DBname        = 'smartcity4u';

    public $conn;

    

    function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->DBname;charset=utf8", $this->MySqlUsername, $this->MySqlPassword, []);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $this->conn = $conn;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function __destruct()
    {
        $this->conn->commit();
        $this->conn = null;
    }

}

function Register($name, $gender, $email, $phone, $target, $org, $type, $note){
    try{

        $dbObject = new DB;
        $dbObject->conn->exec("INSERT INTO `users`(u_name, gender, email, phone, targeted, org, types, note )
        VALUES(
            '$name', 
            '$gender', 
            '$email', 
            '$phone', 
            '$target', 
            '$org', 
            '$type', 
            '$note')
        ");

        return TRUE;

    } catch (PDOException $er){
        return FALSE;
    }

}



?>

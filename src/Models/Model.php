<?php
namespace App\Models;

use PDO;
use App\Database\MysqlDatabaseQuery;
use App\Database\MysqlDatabaseConnect;

class Model{
    protected PDO $pdo;
    protected MysqlDatabaseQuery $query;


    public function __construct(){
        $conn = MysqlDatabaseConnect::getInstance();
        $this->pdo = $conn->getConnection();
        $this->query = new MysqlDatabaseQuery($this->pdo);
    }
}
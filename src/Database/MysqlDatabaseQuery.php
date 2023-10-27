<?php
namespace App\Database;

use PDO;
use PDOException;
use App\Contracts\Database\DatabaseQueryInterface;

class MysqlDatabaseQuery implements DatabaseQueryInterface {

    public function __construct(private PDO $pdo){
        
    }

    public function query(string $query, array $bindings = []) {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($bindings);
            return $statement;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function insert(string $table, array $data) {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        return $this->query($query, $data);
    }

    public function update(string $table, array $data, array $bindings = []) {
        $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($bindings)));

        $query = "UPDATE $table SET $setClause WHERE $whereClause";

        $mergedBindings = array_merge($data, $bindings);

        return $this->query($query, $mergedBindings);
    }

    public function delete(string $table, array $bindings = []) {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($bindings)));

        $query = "DELETE FROM $table WHERE $whereClause";

        return $this->query($query, $bindings);
    }


    public function truncate(string $table, array $bindings = []) {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($bindings)));
        $query = "TRUNCATE TABLE $table WHERE $whereClause";
        
        return $this->query($query, $bindings);
    }

    public function statement(string $query, array $bindings = []) {
        return $this->query($query, $bindings);
    }
}

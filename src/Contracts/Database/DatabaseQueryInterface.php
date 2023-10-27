<?php
namespace App\Contracts\Database;

interface DatabaseQueryInterface{
    public function query(string $query, array $bindings = []);

    public function insert(string $table, array $data);
    public function update(string $table, array $data, array $bindings = []);
    public function delete(string $table, array $bindings = []);

    public function truncate(string $table, array $bindings = []);
    public function statement(string $query, array $bindings = []);

    
}
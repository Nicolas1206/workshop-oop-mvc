<?php

namespace models;

class User extends Database{
    /**
     * @param string $email
     * 
     * @return array
     */
    public function getUserByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = Database::query($sql, ["email" => $email]
    );
    return $result->fetch();
    }
    /**
     * @param array $param
     * 
     * @return array
     */
    public function getUserByUsernameAndEmail(array $param): array|bool
    {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $result = Database::query(
            $sql, 
            $param
    );
    return $result->fetch();
    }
    public function insertNewUser(array $param): array 
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $result = Database::exec(
            $sql,
            $param
        );
        $id = Database::lastInsertId();
        return [
            "bool" => $result, 
            "id" => $id
        ];
    }
}
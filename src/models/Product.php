<?php

namespace models;

class Product extends Database
{
    public function getAllProduct(): array|bool
    {
        $sql = "SELECT * FROM products LIMIT 20";
        $result = Database::query($sql);
        return $result->fetchAll();
    }

    public function getProductInfo(string $productCode): array|bool
    {
        $sql = "SELECT * FROM products WHERE productCode = :productCode";
        $result = Database::query($sql, ["productCode" => $productCode]);
        return $result->fetch();
    }
}
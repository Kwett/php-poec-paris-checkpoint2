<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE1 = 'cupcake';
    public const TABLE2 = 'accessory';

    public function insert(array $cupcake): void
    {
        $query = "INSERT INTO " . self::TABLE1 . " (name, color1, color2, color3, accessory_id, created_at) 
                VALUES (:name, :color1, :color2, :color3, :accessory_id, :created_at)";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue(':color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue(':color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue(':color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue(':accessory_id', $cupcake['accessory'], PDO::PARAM_STR);
        $statement->bindValue(':created_at', $cupcake['created_at'], PDO::PARAM_STR);
        $statement->execute();
    }

    public function getAllCupcakes(): array
    {
        $query = "SELECT c.id AS cupcake_id, c.name, c.color1, c.color2, c.color3, c.accessory_id, c.created_at,
                        a.id AS accessory_id, a.url
                FROM cupcake c
                INNER JOIN accessory a ON c.accessory_id = a.id
                ORDER BY c.id DESC";
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getCupcakeById($id): array
    {
        $query = "SELECT c.id AS cupcake_id, c.name, c.color1, c.color2, c.color3, c.accessory_id, c.created_at,
                        a.id AS accessory_id, a.url
                FROM cupcake c
                INNER JOIN accessory a ON c.accessory_id = a.id
                WHERE c.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $cupcake = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $cupcake;
    }
}
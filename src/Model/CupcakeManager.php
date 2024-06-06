<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public function insert(array $data)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (name, color1, color2, color3, accessory_id) VALUES (:name, :color1, :color2, :color3, :accessory_id);"
        );
        $statement->bindValue('name', $data['name']);
        $statement->bindValue('color1', $data['color1']);
        $statement->bindValue('color2', $data['color2']);
        $statement->bindValue('color3', $data['color3']);
        $statement->bindValue('accessory_id', $data['accessory']);

        $statement->execute();
    }
    public function selectAll(string $orderBy = 'id', string $direction = 'DESC'): array
    {
        $query = 'SELECT c.*, a.url AS `url` FROM ' . static::TABLE . " AS c 
        INNER JOIN accessory AS a 
        ON c.accessory_id=a.id";

        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        $query .= ";";

        return $this->pdo->query($query)->fetchAll();
    }
    public function selectOneById(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "SELECT c.*, a.name AS accessory, a.url AS `url` FROM " . static::TABLE . " AS c 
        INNER JOIN accessory AS a 
        ON c.accessory_id=a.id 
        WHERE c.id=:id"
        );
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}

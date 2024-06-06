<?php

namespace App\Model;

use App\Model\AbstractManager;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function save($name, $color1, $color2, $color3, $accessoryId)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE . " (name, 
        color1, 
        color2, 
        color3, 
        accessory_id) 
        VALUES (
            :name, 
            :color1, 
            :color2, 
            :color3, 
            :accessory_id)");
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':color1', $color1, \PDO::PARAM_STR);
        $statement->bindValue(':color2', $color2, \PDO::PARAM_STR);
        $statement->bindValue(':color3', $color3, \PDO::PARAM_STR);
        $statement->bindValue(':accessory_id', $accessoryId['id'], \PDO::PARAM_STR);
        $statement->execute();
    }
}

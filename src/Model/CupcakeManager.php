<?php

namespace App\Model;

use PDO;
use DateTime;

class CupcakeManager extends AbstractManager
{
    public const TABLE = "cupcake";

    public function insert(array $cupcake): bool
    {

        $dateTime = new DateTime();
        $createdAt = $dateTime->format('Y-m-d H:i:s');

        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (`name`,`color1`,`color2`,`color3`,`accessory_id`,`created_at`)
            VALUES (:name, :color1, :color2, :color3, :accessory_id, :created_at);"
        );
        $statement->bindValue("name", $cupcake["name"], PDO::PARAM_STR);
        $statement->bindValue("color1", $cupcake["color1"], PDO::PARAM_STR);
        $statement->bindValue("color2", $cupcake["color2"], PDO::PARAM_STR);
        $statement->bindValue("color3", $cupcake["color3"], PDO::PARAM_STR);
        $statement->bindValue("accessory_id", $cupcake["accessory"], PDO::PARAM_STR);
        $statement->bindValue("created_at", $createdAt, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function getCupcakeAccesories()
    {
        $query =
            "SELECT c.* , a.*
            FROM " . self::TABLE . " AS c
            INNER JOIN accessory AS a
            ON c.accessory_id = a.id
            ORDER BY c.id DESC;"
        ;

        return $this->pdo->query($query)->fetchAll();
    }
}

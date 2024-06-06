<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(array $cupcake): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " 
            (`name`, `color1`, `color2`, `color3`, `accessory_id`, `created_at`) 
            VALUES 
            (:name, :color1, :color2, :color3, :accessory_id, NOW())"
        );
        $statement->bindValue(':name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue(':color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue(':color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue(':color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue(':accessory_id', $cupcake['accessory_id'], PDO::PARAM_INT);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function selectAll(string $orderBy = 'id', string $direction = 'DESC'): array
    {
        $query = "SELECT c.*, a.name as accessory_name, a.url as accessory_url 
                  FROM " . self::TABLE . " c 
                  LEFT JOIN accessory a ON c.accessory_id = a.id 
                  ORDER BY " . $orderBy . " " . $direction;
        $statement = $this->pdo->query($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as &$result) {
            if (isset($result['accessory_url'])) {
                $result['url'] = $result['accessory_url'];
            } else {
                $result['url'] = 'http://images.innoveduc.fr/php_parcours/cp2/donut.png';
            }
        }
    
        return $results;
    }
}

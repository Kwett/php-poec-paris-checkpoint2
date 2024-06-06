<?php

namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function insert(array $accessory): void
    {
        // Insérer les données dans la table 'invoice'
        $invoiceQuery = "INSERT INTO " . self::TABLE . "
                 (name, url)
                 VALUES
                 (:name, :url)";

        $invoiceStatement = $this->pdo->prepare($invoiceQuery);
        $invoiceStatement->bindValue(':name', $accessory['name'], PDO::PARAM_STR);
        $invoiceStatement->bindValue(':url', $accessory['url'], PDO::PARAM_STR);
        $invoiceStatement->execute();
    }
}

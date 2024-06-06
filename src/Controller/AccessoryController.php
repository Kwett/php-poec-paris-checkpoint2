<?php

namespace App\Controller;

use App\Model\AccessoryManager;
/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    /**
     * Display accessory creation page
     * Route /accessory/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $accessory = [];
        $accesManager = new AccessoryManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new accessory
            $accessory = $_POST;

            foreach ($accessory as $key => $value) {
                $accessory[$key] = is_string($value) ? trim($value) : $value;
            }

            $id = $accesManager->insert($accessory);
            
            header('Location:/accessory/list');
        }
        return $this->twig->render(
            'Accessory/add.html.twig',
            [
                'accessory' => $accessory,
            ]
        );
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list($orderBy = '', $direction = 'ASC')
    {
        $accesManager = new AccessoryManager();

        $accessory = $accesManager->selectAll($orderBy, $direction);
        
        //TODO Add your code here to retrieve all accessories
        return $this->twig->render(
            'Accessory/list.html.twig',
            [
                'accessories' => $accessory,
            ]
        );
    }
}

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
    private $accessoryManager;

    public function __construct()
    {
        parent::__construct();
        $this->accessoryManager = new AccessoryManager();
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accessory = array_map('htmlentities', array_map('trim', $_POST));
            $this->accessoryManager->insert($accessory);

            header('Location:/accessory/list');
        }
        return $this->twig->render('Accessory/add.html.twig');
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $accessories = $this->accessoryManager->selectAll();

        return $this->twig->render('Accessory/list.html.twig', [
            'accessories' => $accessories
        ]);
    }
}

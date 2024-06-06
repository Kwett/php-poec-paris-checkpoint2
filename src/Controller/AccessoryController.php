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

    private AccessoryManager $accessoryManager;

    public function __construct()
    {
        parent::__construct();
        $this->accessoryManager = new AccessoryManager();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            //TODO Add your code here to create a new accessory

            $accessory = array_map('htmlentities', array_map('trim', $_POST));

            if (empty($accessory['name']) || empty($accessory['url'])) {
                $errors[] = 'Your form is incomplete';
                return $this->twig->render('Accessory/add.html.twig', ['errors' => $errors,]);
            }

            if (empty($errors)) {
                $this->accessoryManager->insert($accessory);
                header('Location:/accessory/list');
                // exit();
            }
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
        //TODO Add your code here to retrieve all accessories
        $accessories = $this->accessoryManager->selectAll();
        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories,]);
    }
}

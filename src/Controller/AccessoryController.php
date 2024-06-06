<?php

namespace App\Controller;

use App\Model\AccessoryManager;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    private AccessoryManager $accessoryManager;

    public function __construct()
    {
        parent::__construct();
        $this->accessoryManager = new AccessoryManager();
    }

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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accessory = array_map('htmlentities', array_map('trim', $_POST));

            if (empty($accessory['name']) ||
                empty($accessory['url']))
            {
                $errors[] = 'Complete all the fields if you want a cute accessory!';
            }

            if (empty($errors)) {
                $this->accessoryManager->insert($accessory);
                header('Location:/accessory/list');
            }
        }
        return $this->twig->render('Accessory/add.html.twig', [
            'errors' => $errors,
        ]);
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
        $accessories = $this->accessoryManager->getAllAccessories();
        return $this->twig->render('Accessory/list.html.twig', [
            'accessories' => $accessories
        ]);
    }
}

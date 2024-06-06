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

    private $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new AccessoryManager();
    }

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', array_map('htmlentities', $_POST));

            if (empty($data['name'])) {
                $errors['name'] = 'Enter a name';
            }

            if (empty($data['url'])) {
                $errors['url'] = 'Enter an url';
            }

            if (empty($errors)) {
                $this->manager->insert($data);
            }
            //TODO Add your code here to create a new accessory
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
        //TODO Add your code here to retrieve all accessories
        $accessories = $this->manager->selectAll();
        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}

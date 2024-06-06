<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\CupcakeManager;
use App\Model\AccessoryManager;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    private $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new CupcakeManager();
    }
    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', array_map('htmlentities', $_POST));

            if(empty($data['name'])) {
                $errors['name'] = 'Enter a name';
            }

            if(empty($data['color1'])) {
                $errors['color1'] = 'Enter a color1';
            }

            if(empty($data['color2'])) {
                $errors['color2'] = 'Enter a color2';
            }

            if(empty($data['color3'])) {
                $errors['color3'] = 'Enter a color3';
            }

            if(empty($data['accessory'])) {
                $errors['accessory_id'] = 'Enter an accessory';
            }

            if (empty($errors)) {
                $this->manager->insert($data);
            }
            //TODO Add your code here to create a new cupcake
            header('Location:/cupcake/list');
        }
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        //TODO Retrieve all cupcakes
        $cupcakes = $this->manager->selectAllJoined('cupcake.id', 'DESC');
        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show($id): string
    {
        $cupcake = $this->manager->selectOneByIdJoined($id);
        var_dump($cupcake);
        return $this->twig->render('Show/onecupcake.html.twig', ['cupcake' => $cupcake]);
    }
}

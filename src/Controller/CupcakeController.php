<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\CupcakeManager;
use App\Service\Container;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    private AccessoryManager $accessoryManager;
    private CupcakeManager $cupcakeManager;

    public function __construct()
    {
        parent::__construct();
        $this->accessoryManager = new AccessoryManager();
        $this->cupcakeManager = new CupcakeManager();
    }

    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new cupcake

            $errors =  [];

            $cupcake = array_map('htmlentities', array_map('trim', $_POST));

            if (empty($_POST['name'])
                || empty($_POST['color1'])
                || empty($_POST['color2'])
                || empty($_POST['color3']) 
                || empty($_POST['accessory'])) {
                $errors = 'All fields are required.';
                return $this->twig->render('Cupcake/add.html.twig', ['errors' => $errors,]);
            }

            if (empty($errors)) {
                $this->cupcakeManager->insert($cupcake);
                header('Location:/cupcake/list');
                exit();
            }
        }
        //TODO retrieve all accessories for the select options
        $accessories = $this->accessoryManager->selectAll();

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
    public function list(): string
    {
        //TODO Retrieve all cupcakes
        $cupcakes = $this->cupcakeManager->getMyCupcakes();
        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show(int $id): string
    {
        $cupcake = $this->cupcakeManager->selectOneCupcakeById($id);
        return $this->twig->render('Cupcake/detail.html.twig', ['cupcake' => $cupcake]);
    }
}

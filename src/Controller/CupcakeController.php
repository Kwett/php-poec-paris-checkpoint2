<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\AccessoryManager;
use App\Model\CupcakeManager;

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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = array_map('htmlentities', array_map('trim', $_POST));

            if (empty($cupcake['name']) ||
                empty($cupcake['color1']) ||
                empty($cupcake['accessory']))
            {
                $errors[] = 'Choose at least a name, color and accessory if you want a beautiful cupcake!';
            }
            
            if (empty($errors)) {
                $this->cupcakeManager->insert($cupcake);
                header('Location:/cupcake/list');
            }
        }

        $accessories = $this->accessoryManager->getAllAccessories();
        return $this->twig->render('Cupcake/add.html.twig', [
            'accessories' => $accessories
        ]);
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
        $cupcakes = $this->cupcakeManager->getAllCupcakes();
        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }
}

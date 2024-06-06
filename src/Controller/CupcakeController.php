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
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    private $cupcakeManager;
    private $accessoryManager;

    public function __construct()
    {
        parent::__construct();
        $this->cupcakeManager = new CupcakeManager();
        $this->accessoryManager = new AccessoryManager();
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedAccessory = $this->accessoryManager->selectOneByName($_POST['accessory']);
            $this->cupcakeManager->save(
                $_POST['name'],
                $_POST['color1'],
                $_POST['color2'],
                $_POST['color3'],
                $selectedAccessory
            );
            header('Location:/cupcake/list');
        }
        $accessories = $this->accessoryManager->selectAll();
        return $this->twig->render(
            'Cupcake/add.html.twig',
            ['accessories' => $accessories]
        );
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
        $cupcakes = $this->cupcakeManager->selectAll();
        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }
}

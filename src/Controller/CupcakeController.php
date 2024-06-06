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
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = array_map('htmlentities', array_map('trim', $_POST));
            $cupcakeManager = new CupcakeManager();
            $cupcakeManager->insert($cupcake);
            header('Location:/cupcake/list');
        }
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
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
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll();
        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }

    public function show(string $id)
    {
        $cupcakeManager = new CupcakeManager();
        $cupcake = $cupcakeManager->selectOneById($id);
        return $this->twig->render('Cupcake/show.html.twig', [
            'cupcake' => $cupcake
        ]);
    }
}

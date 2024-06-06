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
    private $accessoryManager;
    private $cupcakeManager;
    public function __construct()
    {
        parent::__construct();
        $this->accessoryManager = new AccessoryManager();
        $this->cupcakeManager = new CupcakeManager();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = array_map('htmlentities', array_map('trim', $_POST));
            $this->cupcakeManager->insert($cupcake);
            header('Location:/cupcake/list');
        }
        $accessories = $this->accessoryManager->selectAll();
        return $this->twig->render(
            'Cupcake/add.html.twig',
            [
                'accessories' => $accessories
            ]
        );
    }

    public function show(int $id)
    {
        $cupcakes = $this->cupcakeManager->selectOneByIdWithAccessories($id);
        foreach ($cupcakes as $cupcake) {
            $cupcake["name"] = html_entity_decode($cupcake["name"]);


            return $this->twig->render('cupcake/show.html.twig', [
            'cupcake' => $cupcake
            ]);
        }
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
        $cupcakes = $this->cupcakeManager->getCupcakesWithAccesories();

        foreach ($cupcakes as &$cupcake) {
            $cupcake["name"] = html_entity_decode($cupcake["name"]);
        }

        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }
}

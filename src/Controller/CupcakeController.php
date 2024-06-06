<?php

namespace App\Controller;

use App\Model\CupcakeManager;
use App\Model\AccessoryManager;

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
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $color1 = isset($_POST['color1']) ? trim($_POST['color1']) : null;
            $color2 = isset($_POST['color2']) ? trim($_POST['color2']) : null;
            $color3 = isset($_POST['color3']) ? trim($_POST['color3']) : null;
            $accessoryId = isset($_POST['accessory']) ? (int)$_POST['accessory'] : null;

            $errors = [];

            if (empty($name)) {
                $errors[] = 'Cupcake name is required';
            }

            if (empty($color1)) {
                $errors[] = 'Color first cream is required';
            }

            if (empty($errors)) {

                $cupcakeManager = new CupcakeManager();
                $cupcakeManager->insert([
                    'name' => $name,
                    'color1' => $color1,
                    'color2' => $color2,
                    'color3' => $color3,
                    'accessory_id' => $accessoryId,
                ]);
                header('Location:/cupcake/list');
                exit;
            } else {

                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
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
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll();

        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }
}

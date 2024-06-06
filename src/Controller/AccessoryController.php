<?php

namespace App\Controller;

use App\Model\AccessoryManager;

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
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $url = isset($_POST['url']) ? trim($_POST['url']) : null;

            $errors = [];

            if (empty($name)) {
                $errors[] = 'Accessory name is required';
            }

            if (empty($url)) {
                $errors[] = 'Accessory image URL is required';
            } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
                $errors[] = 'Invalid URL format';
            }

            if (empty($errors)) {

                $accessoryManager = new AccessoryManager();
                $accessoryManager->insert(['name' => $name, 'url' => $url]);
                header('Location:/accessory/list');
                exit;
            } else {

                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
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

        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();

        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}

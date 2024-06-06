<?php

namespace App\Controller;

use App\Service\Container;

class LogisticController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcakeNumber = trim($_POST['cupcakeNumber']);
            $container = new Container();
            $packages = $container->inbox((int) $cupcakeNumber);
        }
        return $this->twig->render(
            'Logistic/index.html.twig',
            [
                'packages' => $packages
            ]
        );
    }
}

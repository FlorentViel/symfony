<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        return new Response ("Liste des évenements");
    }
}

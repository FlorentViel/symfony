<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    // /**
    //  * @Route("/", name="")
    //  */

    // public function search()
    // {
    //     $builder->add('naim', null, array(
    //         'required'   => false,
    //         'emptyData' => 'Rechercher',
        
    //     ));

    //     return $this->render('base.html.twig');

    // }
}

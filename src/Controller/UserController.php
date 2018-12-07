<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UserService;
use App\Entity\User;
use App\Form\UserRegisterType;
use App\Form\LoginType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController
{

    /**
    * @Route("register", name="register")
    */
    public function add( Request $request, UserService $userService)
    {
        $user = new User();
        //$user = new AppBundle\Entity\User();
        $form = $this->createForm(UserRegisterType::Class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

            $userService->registerUser( $user );

            return $this->redirectToRoute('user', array('id' => $user->getId()));
        }

        return $this->render('user/register.html.twig',[ 
            "form" =>  $form->createView()
        ]);
    }

    /**
    * @Route("login", name="login")
    */
    public function login( Request $request, UserService $userService, AuthenticationUtils $authenticationUtils)
    {


        return $this->render('user/login.html.twig',[ 
            "lastUserName" =>  $authenticationUtils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name ="logout")
     */

     public function logout()
     {
         
        return $this->render('event/index.html.twig');
     }
}

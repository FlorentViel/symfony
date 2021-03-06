<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

use App\Service\EventService;

use App\Entity\Event;
use App\Form\EventType;



class EventController extends AbstractController
{




    /**
     * @Route("/event", name="event_list")
     */
    public function list( Request $request , EventService $eventService)
    {

        $page  = $request->query->get('page');

        
        if (empty($page))
        {
            $page = 1;
        }

        $querySort = $request->query->get('sort');
        $querySearch = $request->query->get('querySearch');
        return $this->render( "event/index.html.twig", [ 
            "events" => $eventService->getAllByName($querySearch, $querySort, $page),
            "IncomingEvents" => $eventService->getCountByDate(),
            "page" =>$page
        ]);

    }
    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function show( $id, EventService $eventService )
    {


        return $this->render( "event/show.html.twig", [ 
            "event" => $eventService->getOne( $id )
        ]);;
    }
    /**
     * @Route("/event/add", name="event_add")
     */
    public function add( Request $request, EventService $eventService) 
    {   
   
        $event = new Event(); 
        $form = $this->createForm(EventType::Class, $event);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $eventService->add( $event );
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($event);
            // $entityManager->flush();

            //$request->getSession()->getFlashBag()->add('notice', 'Evenement bien enregistrée.');

            return $this->redirectToRoute('event_detail', array('id' => $event->getId()));
        }

        return $this->render( "event/add.html.twig", [ 
            "form" =>  $form->createView()
        ]);
    }


    /**
     * @Route("/event/detail{id}", name="event_detail" , requirements={"id"="\d+"}))
     */

    public function detail($id, EventService $eventService , Request $request)
    {
        //$request->getSession()->getFlashBag()->add('notice', 'Evenement bien enregistrée.');
        return $this->render( "event/detail.html.twig", 
        ["event" => $eventService->getOne( $id )
        ]);
    }


    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")

     */
    public function join( $id )
    {
        return $this->render( "event/join.html.twig");
    }


    
}


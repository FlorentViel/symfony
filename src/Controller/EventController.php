<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


use App\Service\EventService;



class EventController extends AbstractController
{



    /**
     * @Route("/event", name="event_list")
     */
    public function list( Request $request , EventService $eventService)
    {
        $querySort = $request->query->get('sort');
        $querySearch = $request->query->get('querySearch');
        return $this->render( "event/index.html.twig", [ 
            "events" => $eventService->getAllByName($querySearch, $querySort),
            "IncomingEvents" => $eventService->getCountByDate()
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
     * @Route("/event/new", name="event_add")
     */
    public function add()
    {
        return $this->render( "event/index.html.twig");
    }
    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( $id )
    {
        return $this->render( "event/index.html.twig");
    }


    
}
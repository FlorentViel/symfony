<?php
namespace App\Service;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
use App\Form\EventType;

class EventService 
{

    private $om;
    private $eventType;

    public function __construct( ObjectManager $om )
    {
        $this->om = $om;
    }

    public function getAll()
    {
        $repo = $this->om->getRepository( Event::class );
        return $repo->findAll();
    }

    public function getOne( $id ) 
    {
        $repo = $this->om->getRepository( Event::class );
        return $repo->find( $id );
    }

    public function getAllByName($nom , $sort, $page)
    {

        $repo = $this->om->getRepository(Event::class);
        
        return $repo->findName($nom, $sort, $page);


    }

    public function getCountByDate() {

        $repo = $this->om->getRepository(Event::class);
        
        return $repo->Incommingcount();

    }





}


?>
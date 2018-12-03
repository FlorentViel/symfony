<?php
namespace App\Service;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
class EventService 
{

    private $om;

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

    public function getAllByName($nom , $sort)
    {

        $repo = $this->om->getRepository(Event::class);
        
        return $repo->findName($nom, $sort);


    }

    public function getCountByDate() {

        $repo = $this->om->getRepository(Event::class);
        
        return $repo->Incommingcount();

    }



}


?>
<?php
namespace App\Service;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
use App\Entity\User;
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

    public function add($event) {

        $repo = $this->om->getRepository(User::class);
        $user = $repo->find( 1 );        
        $event->setOwner($user);

        $this->setupMedia( $event );
        $this->om->persist($event);
        $this->om->flush();

        
    }

    private function setupMedia( $event ){
        if( !empty( $event->getPosterUrl() ) ){
            return $event->setPoster( $event->getPosterUrl() );
        }
        $file = $event->getPosterFile();
        $filename = md5( uniqid() ) . '.' . $file->guessExtension();
        $file->move( './data', $filename );
        return $event->setPoster( $filename );
    }
    

}
?>
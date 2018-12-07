<?php
namespace App\Repository;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
      {
        parent::__construct($registry, Event::class);
    }
    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findName($value, $sort, $page)
    {

        $stmt = $this->createQueryBuilder('e')

            ->andWhere("e.name LIKE :val")
            //->andWhere("e.$param LIKE :param")
            ->setParameter('val', '%'.$value.'%');
            //->setParameter('param', '%'.$param.'%')
            if ( $sort == "price" )
            {
            $stmt ->orderBy('e.price' , 'ASC');
            }

            elseif ($sort == "date")
            {
            $stmt ->orderBy('e.createdAt' , 'DESC');
            }
 
            $limit = 2;
            $stmt ->setMaxResults($limit)
            //->getInt('page', 1)
            ->setFirstResult( ($page - 1 )*$limit)
        ;

            return $stmt->getQuery()
            ->getResult()
        ;
    }

    public function Incommingcount()
    {
        return $this->createQueryBuilder('e')
        ->select('count(e)')
        ->andWhere('e.startAt > :bind')
        ->setParameter('bind', new \DateTime())
        ->getQuery()
        ->getSingleScalarResult()
        ;


    }





}
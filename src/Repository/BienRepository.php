<?php

namespace App\Repository;

use App\Entity\Bien;
use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Controller\Session; 

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }
    
    public function getUnBien($id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('b')
            ->from(Bien::class,'b')
            ->where('b.id = :id')
            ->setParameter('id', $id);
        
        $query = $qb->getQuery();
        
        $result = $query->getOneOrNullResult();
        
        return $result;
    }
    
    public function rechercherParType($type) {

        $queryBuilder = $this->_em->createQueryBuilder('b') ;
        $queryBuilder

        ->select('b')
            ->from(Bien::class,'b')
            ->innerJoin(\App\Entity\Type::class,'c','WITH','c.id = b.Type')
            ->where('c.id= :id')
            ->setParameter('id',$type);
        $query= $queryBuilder->getQuery();
        $result= $query->getResult();


        return $result;

    } 
    
    public function rechercherParType2($type) {

        $req =$this->_em->createQuery("SELECT b FROM App\Entity\Bien b JOIN b.Type t WHERE t.id = ?1 AND b.etat LIKE '%en attente%' ");
        $req->setParameter(1, $type);
            $bien = $req->getResult();
        return $bien;

    }
    
    
      

    // /**
    //  * @return Bien[] Returns an array of Bien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

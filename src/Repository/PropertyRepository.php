<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return QueryBuilder 
     */
    private function findUnsoldQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
        ->where('p.sold = false'); 
    }

    /**
     * @return Query
     */
    public function findAllUnsoldQuery(PropertySearch $search): Query
    {
        $query = $this->findUnsoldQuery();

        if ($search->getMaxPrice()) {
            $query = $query
                ->andwhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice())
            ;
        }

        if ($search->getMinSurface()) {
            $query = $query
                ->andwhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface())
            ;
        }

        if ($search->getOptions()->count() > 0) {
            $key = 0;
            foreach ($search->getOptions() as $option) {
                $key++;
                $query = $query
                ->andwhere(":option$key MEMBER OF p.options")
                ->setParameter("option$key", $option);
            }
        }

        return $query->getQuery();
    }
    
    /**
     * @return Property[] 
     */
    public function findLastest(): array
    {
        return $this->findUnsoldQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }


    
    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

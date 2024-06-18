<?php

namespace App\Repository;

use App\Entity\Incidence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Incidence>
 *
 * @method Incidence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incidence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incidence[]    findAll()
 * @method Incidence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Incidence::class);
    }

    /**
     * @return Incidence[] Returns an array of Incidence objects
     */
    public function findByCriteria($criteria)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.description LIKE :criteria OR i.type LIKE :criteria')
            ->setParameter('criteria', '%'.$criteria.'%')
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

<?php

namespace App\Repository;

use App\Entity\Incidence;
use App\Entity\Incident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Incident>
 *
 * @method Incident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incident[]    findAll()
 * @method Incident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Incidence::class);
    }

    /**
     * @return Incidence[] Returns an array of Incident objects
     */
    public function findByCriteria($criteria)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.description LIKE :criteria')
            ->setParameter('criteria', '%'.$criteria.'%')
            ->orderBy('i.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

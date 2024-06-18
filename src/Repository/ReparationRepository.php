<?php

namespace App\Repository;

use App\Entity\Reparation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Reparation>
 */
class ReparationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reparation::class);
    }

    /**
     * Recherche des réparations par critères.
     * 
     * @param array $criteria
     * @return Reparation[]
     */
    public function findByCriteria(array $criteria): array
    {
        $qb = $this->createQueryBuilder('r');

        if (isset($criteria['description'])) {
            $qb->andWhere('r.description LIKE :description')
               ->setParameter('description', '%' . $criteria['description'] . '%');
        }

        if (isset($criteria['cout'])) {
            $qb->andWhere('r.cout = :cout')
               ->setParameter('cout', $criteria['cout']);
        }

        return $qb->getQuery()->getResult();
    }
    /**
     * @return Reparation[] Returns an array of Reparation objects
     */
    public function findByDescription(string $description): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.description LIKE :description')
            ->setParameter('description', '%' . $description . '%')
            ->getQuery()
            ->getResult();
    }
}
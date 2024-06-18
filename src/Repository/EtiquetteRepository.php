<?php

namespace App\Repository;

use App\Entity\Etiquette;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Etiquette>
 */
class EtiquetteRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Etiquette::class);
        $this->entityManager = $entityManager;
    }

    /**
     * Récupère toutes les étiquettes.
     *
     * @return Etiquette[] Liste des étiquettes
     */
    public function findAllEtiquettes(): array
    {
        return $this->findAll();
    }

    /**
     * Recherche une étiquette par son ID.
     *
     * @param int $id L'ID de l'étiquette à rechercher
     * @return Etiquette|null L'étiquette correspondante ou null si non trouvée
     */
    public function findEtiquetteById(int $id): ?Etiquette
    {
        return $this->find($id);
    }

    /**
     * Modifie une étiquette existante.
     *
     * @param Etiquette $etiquette L'étiquette à modifier
     * @return Etiquette L'étiquette modifiée
     */
    public function updateEtiquette(Etiquette $etiquette): Etiquette
    {
        $this->entityManager->persist($etiquette);
        $this->entityManager->flush();

        return $etiquette;
    }

    /**
     * Recherche les étiquettes par un critère donné.
     *
     * @param array $criteria Critères de recherche
     * @return Etiquette[] Liste des étiquettes correspondantes
     */
    public function searchEtiquettes(array $criteria): array
    {
        return $this->findBy($criteria);
    }
}

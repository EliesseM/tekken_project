<?php

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rating>
 */
class RatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }
    public function getAverageRatingsForAllCharacters(): array
    {
        $results = $this->createQueryBuilder('r')
            ->select('IDENTITY(r.character) AS characterId, AVG(r.score) AS avgScore')
            ->groupBy('r.character')
            ->getQuery()
            ->getResult();

        // Transformer en tableau [characterId => moyenne]
        $averages = [];
        foreach ($results as $row) {
            $averages[$row['characterId']] = $row['avgScore'];
        }

        return $averages;
    }
    public function getAverageRatingForCharacter(int $characterId): ?float
    {
        return (float) $this->createQueryBuilder('r')
            ->select('AVG(r.score) as avgRating')
            ->where('r.character = :characterId')
            ->setParameter('characterId', $characterId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}

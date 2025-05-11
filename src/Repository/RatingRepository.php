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
    public function getAverageRatingForCharacter(int $characterId): ?float
    {
        $qb = $this->createQueryBuilder('r')
            ->select('AVG(r.score) as avgRating')
            ->where('r.character = :characterId')
            ->setParameter('characterId', $characterId);

        return (float) $qb->getQuery()->getSingleScalarResult();
    }
}

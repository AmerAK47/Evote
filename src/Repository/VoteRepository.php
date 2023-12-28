<?php

namespace App\Repository;

use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vote[]    findAll()
 * @method Vote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vote::class);
    }

    public function countVotesByCandidat(): array
    {
        $qb = $this->createQueryBuilder('v')
            ->select('c.id as candidatId, COUNT(v.id) as voteCount')
            ->leftJoin('v.candidat', 'c')
            ->groupBy('candidatId');

        $results = $qb->getQuery()->getResult();

        $voteCounts = [];
        foreach ($results as $result) {
            $candidatId = $result['candidatId'];
            $voteCount = $result['voteCount'];
            $voteCounts[$candidatId] = $voteCount;
        }

        return $voteCounts;
    }
}

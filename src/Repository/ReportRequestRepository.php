<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\ReportRequest;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReportRequest>
 *
 * @method ReportRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportRequest[]    findAll()
 * @method ReportRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportRequest::class);
    }

    public function countReportRequestFromAccountIn24Hours( Account  $user): int
    {
        $date = new DateTime();
        $date->modify('-24 hours');
        return $this->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.account = :account')
            ->andWhere('r.createdAt > :date')
            ->setParameter('account', $user)
            ->setParameter('date', $date)
            ->getQuery()
            ->getSingleScalarResult();
    }
}

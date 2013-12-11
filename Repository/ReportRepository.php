<?php

namespace San\ReportBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class ReportRepository extends Repository
{
    /**
     * @param  string    $type
     * @param  \DateTime $from
     * @param  \DateTime $to
     * @return \Doctrine\ODM\MongoDB\LoggableCursor
     */
    public function countByTypeDate($type, \DateTime $from, \DateTime $to)
    {
        return $this
            ->createQueryBuilder('report')
            ->field('type')->equals($type)
            ->field('created')->range($from, $to)
            ->getQuery()
            ->execute()
        ;
    }
}

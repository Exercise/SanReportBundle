<?php

namespace San\ReportBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use FOS\UserBundle\Model\UserInterface;
use San\ReportBundle\Model\Report;

class ReportRepository extends DocumentRepository
{
    /**
     * @param  Report    $report
     * @param  \DateTime $from
     * @param  \DateTime $to
     * @return \Doctrine\ODM\MongoDB\LoggableCursor
     */
    public function countByReportDate(Report $report, \DateTime $from, \DateTime $to)
    {
        $from->setTime(0, 0, 0);
        $to->setTime(23, 59, 59);
        $collection = $this->dm->getDocumentCollection(get_class($report))->getMongoCollection();
        $filters = $this->getReportFilters($report, array(
            'type' => $report->getType(),
            'created' => array(
                '$gte' => new \MongoDate($from->getTimestamp()),
                '$lte' => new \MongoDate($to->getTimestamp()),
            )
        ));

        $reportData = [];
        $cursor = $collection->find($filters)->sort(['created' => 1]);
        foreach ($cursor as $row) {
            $key = date('Ymd', $row['created']->sec);
            if (!isset($reportData[$key])) {
                $reportData[$key] = 0;
            }
            $reportData[$key] += 1;
        }

        $result = array('result' => array());
        $diff = $to->diff($from);
        $date = clone $from;
        for ($i = 0; $i <= $diff->days; $i++) {
            $key = $date->format('Ymd');
            $result['result'][] = array(
                '_id' => array(
                    'year'  => $date->format('Y'),
                    'month' => $date->format('m'),
                    'day'   => $date->format('d')
                ),
                'total' => isset($reportData[$key]) ? $reportData[$key] : 0
            );
            $date->add(new \DateInterval('P1D'));
        }

        return $result;
    }

    /**
     * @param  string        $type
     * @param  UserInterface $user
     * @return \San\ReportBundle\Document\Report
     */
    public function findOneByTypeUser($type, UserInterface $user)
    {
        return $this
            ->createQueryBuilder('report')
            ->field('type')->equals($type)
            ->field('user.$id')->equals(new \MongoId($user->getId()))
            ->getQuery()
            ->getSingleResult()
        ;
    }

    /**
     * @param  string        $type
     * @param  UserInterface $user
     * @param  \DateTime     $created
     * @return \San\ReportBundle\Document\Report
     */
    public function findOneByTypeUserCreated($type, UserInterface $user, \DateTime $created)
    {
        $start = clone $created;
        $start->setTime(0, 0, 0);
        $end = clone $created;
        $end->setTime(23, 59, 59);

        return $this
            ->createQueryBuilder('report')
            ->field('type')->equals($type)
            ->field('user.$id')->equals(new \MongoId($user->getId()))
            ->field('created')->range($start, $end)
            ->getQuery()
            ->getSingleResult()
        ;
    }

    /**
     * @param  Report    $report
     * @param  \DateTime $from
     * @param  \DateTime $to
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function getByTypeCreatedQuery($type, \DateTime $from, \DateTime $to)
    {
        return $this
            ->createQueryBuilder('report')
            ->field('type')->equals($type)
            ->field('created')->range($from, $to)
        ;
    }

    /**
     * @param  Report $report
     * @param  array  $filters
     * @return array
     */
    protected function getReportFilters(Report $report, array $filters)
    {
        return $filters;
    }
}

<?php

namespace San\ReportBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
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
        $qb = $this->getByTypeCreatedQuery($report->getType(), $from, $to);
        $collection = $this->dm->getDocumentCollection(get_class($report))->getMongoCollection();
        $filters = $this->getReportFilters($report, array('type' => $report->getType()));

        return $collection->aggregate(array(
            array('$match' => $filters),
            array('$group' => array(
                '_id' => array(
                    'year'  => array('$year' => '$created'),
                    'month' => array('$month' => '$created'),
                    'day'   => array('$dayOfMonth' => '$created')
                ),
                'total' => array('$sum' => 1)
            ))
        ));
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

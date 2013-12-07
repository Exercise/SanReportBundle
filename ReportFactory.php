<?php

namespace San\ReportBundle;

use Doctrine\ODM\MongoDB\DocumentManager;

class ReportFactory
{
    /**
     * @var array
     */
    protected $reports;

    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $dm;

    /**
     * @param array           $reports
     * @param DocumentManager $dm
     */
    public function __construct(array $reports, DocumentManager $dm)
    {
        $this->reports = $reports;
        $this->dm = $dm;
    }

    /**
     * @param  string $reportName
     */
    public function createReport($reportName)
    {
        if (!array_key_exists($reportName, $this->reports)) {
            throw new \InvalidArgumentException(sprintf('Report %s doesnt exist', $reportName));
        }

        $report = new $this->reports[$reportName]();
        $this->dm->persist($report);

        return $report;
    }
}

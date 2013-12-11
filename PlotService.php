<?php

namespace San\ReportBundle;

use Doctrine\Common\Persistence\ObjectManager;
use San\ReportBundle\Model\Report;

class PlotService
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $dm;

    /**
     * @param ObjectManager $dm
     */
    public function __construct(ObjectManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @param  Report $reportModel
     */
    public function getData(Report $reportModel)
    {
        $plotData = array();
        foreach ($reportModel->getReports() as $report) {
            $data = array();
            $reports = $this->dm->getRepository('SanReportBundle:Report')
                ->countByTypeDate($report->getType(), $reportModel->getFrom(), $reportModel->getTo());
            // foreach ($reports as $report) {
            // }
            $plotData[] = array(
                'report' => $filter->getType(),
                'data'   => array()
            );
        }
    }
}

<?php

namespace San\ReportBundle;

use Doctrine\Common\Persistence\ObjectManager;
use San\ReportBundle\Form\Model\Plot;
use San\ReportBundle\Repository\ReportRepository;

class PlotService
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $dm;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @param ObjectManager $dm
     * @param string        $namespace
     */
    public function __construct(ObjectManager $dm, $namespace)
    {
        $this->dm = $dm;
        $this->namespace = $namespace;
    }

    /**
     * @param  Plot $plotModel
     */
    public function getData(Plot $plotModel)
    {
        $plotData = array();
        foreach ($plotModel->getReports() as $report) {
            $data = array();
            $counts = $this->dm->getRepository($this->namespace)->countByReportDate($report, $plotModel->getFrom(), $plotModel->getTo());
            foreach ($counts['result'] as $count) {
                $date = new \DateTime(sprintf('%s-%s-%s', $count['_id']['year'], $count['_id']['month'], $count['_id']['day']));
                $data[] = array($date->getTimestamp(), $count['total']); //array($count->getCreated()->getTimestamp(), $count->getCreated()->);
            }
            $plotData[] = array(
                'report' => $report->getType(),
                'data'   => $data,
            );
        }

        return $plotData;
    }
}

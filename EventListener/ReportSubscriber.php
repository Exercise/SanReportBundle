<?php

namespace San\ReportBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use San\ReportBundle\Model\Report;
use San\ReportBundle\ReportEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReportSubscriber implements EventSubscriberInterface
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
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            ReportEvents::CREATE_REPORT => array('onReportCreate'),
        );
    }

    /**
     * @param  Report $report
     * @return \San\ReportBundle\Model\Report
     */
    public function onReportCreate(Report $report)
    {
        $report->updateFilters();
        $this->dm->persist($report);

        return $report;
    }
}

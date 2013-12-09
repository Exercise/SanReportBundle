<?php

namespace San\ReportBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use San\ReportBundle\Model\AbstractReportEvent;

class ReportNodeListener
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $dm;

    public function __construct(ObjectManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @param  UserRegistrationEvent $event
     */
    public function onReportNode(AbstractReportEvent $event)
    {
        $this->dm->persist($event);
        $this->dm->flush($event);
    }
}

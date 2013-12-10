<?php

namespace San\ReportBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use San\ReportBundle\Model\ActiveUserReport;
use San\ReportBundle\Model\ExercisedReport;
use San\ReportBundle\Model\ProfileReport;
use San\ReportBundle\Model\TrackFoodReport;
use San\ReportBundle\Model\TrackGlucoseReport;
use San\ReportBundle\Model\TrackWeightReport;
use San\ReportBundle\Model\UserRegistrationReport;
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
            ReportEvents::ACTIVE_USER_REPORT       => array('onActiveUserReport'),
            ReportEvents::EXERCISED_REPORT         => array('onExercisedReport'),
            ReportEvents::PROFILE_REPORT           => array('onProfileReport'),
            ReportEvents::TRACK_FOOD_REPORT        => array('onTrackFoodReport'),
            ReportEvents::TRACK_GLUCOSE_REPORT     => array('onTrackGlucoseReport'),
            ReportEvents::TRACK_WEIGHT_REPORT      => array('onTrackWeightReport'),
            ReportEvents::USER_REGISTRATION_REPORT => array('onUserRegistrationReport'),
        );
    }

    // public function onActiveUserReport(ActiveUserReport $report)
    // {
    // }

    // public function onExercisedReport(ExercisedReport $report)
    // {
    // }

    // public function onProfileReport(ProfileReport $report)
    // {
    // }

    // public function onTrackFoodReport(TrackFoodReport $report)
    // {
    // }

    // public function onTrackGlucoseReport(TrackGlucoseReport $report)
    // {
    // }

    // public function onTrackWeightReport(TrakcWeightReport $report)
    // {
    // }

    public function onUserRegistrationReport(UserRegistrationReport $userRegistrationReport)
    {
        $userRegistrationReport->updateFilters();
        $this->dm->persist($userRegistrationReport);

        return $userRegistrationReport;
    }
}

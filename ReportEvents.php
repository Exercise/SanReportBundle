<?php

namespace San\ReportBundle;

class ReportEvents
{
    /**
     * @var string
     */
    const CREATE_REPORT = 'create.report';

    /**
     * @var string
     */
    const ACTIVE_USER_REPORT = 'active.user.report';

    /**
     * @var string
     */
    const EXERCISED_REPORT = 'exercised.report';

    /**
     * @var string
     */
    const TRACK_FOOD_REPORT = 'track.food.report';

    /**
     * @var string
     */
    const TRACK_GLUCOSE_REPORT = 'track.glucose.report';

    /**
     * @var string
     */
    const TRACK_WEIGHT_REPORT = 'track.weight.report';

    /**
     * @var string
     */
    const USER_REGISTRATION_REPORT = 'user.registration.report';

    /**
     * @return array
     */
    public static function getReports()
    {
        return array(
            self::ACTIVE_USER_REPORT       => 'Active user report',
            self::EXERCISED_REPORT         => 'Exercised report',
            self::TRACK_FOOD_REPORT        => 'Track food report',
            self::TRACK_GLUCOSE_REPORT     => 'Track glucose report',
            self::TRACK_WEIGHT_REPORT      => 'Track weight report',
            self::USER_REGISTRATION_REPORT => 'User registration report',
        );
    }
}

<?php

namespace San\ReportBundle;

final class ReportEvents
{
    /**
     * Event which should be fired when new event node is about to create
     * (e.g. new user was created)
     *
     * @var string
     */
    const REPORT_CREATE_NODE = 'report.create_node';
}

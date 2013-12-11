<?php

namespace San\ReportBundle\Form\Model;

class Plot
{
    /**
     * @var \DateTime
     */
    protected $from;

    /**
     * @var \DateTime
     */
    protected $to;

    /**
     * @var array
     */
    protected $reports;

    /**
     * @return \DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \DateTime $from
     */
    public function setFrom(\DateTime $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param \DateTime $from
     */
    public function setTo(\DateTime $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return array
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * @param array $reports
     */
    public function setReports(array $reports)
    {
        $this->reports = $reports;

        return $this;
    }
}

<?php

namespace San\ReportBundle\Form\Model;

class Report
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @return array
     */
    public function getData()
    {
        return $data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}

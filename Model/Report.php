<?php

namespace San\ReportBundle\Model;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\Event;

class Report extends Event
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \FOS\UserBundle\Model\UserInterface
     */
    protected $user;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param  array  $filters
     */
    public function updateFilters()
    {
        foreach ($this->getFilters() as $filter) {
            $value = $this->user->{sprintf('get%s', $filter)}();
            $this->{sprintf('set%s', $filter)}($value);
        }
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array();
    }
}

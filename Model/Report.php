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
     * @var \FOS\UserBundle\Model\UserInterface
     */
    protected $user;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string
     */
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
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
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
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

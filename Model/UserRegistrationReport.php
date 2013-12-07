<?php

namespace San\ReportBundle\Model;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\Event;

class UserRegistrationReport extends Event
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
    public function updateFilters(array $filters = null)
    {
        if (!$filters) {
            $filtersToUpdate = $this->getFilters();
        }

        $invalidFilters = array_diff($filtersToUpdate, $this->getFilters());
        if (count($invalidFilters) > 0) {
            throw new \InvalidArgumentException("This report doesn't have filters: %s", implode(', ', $invalidFilters));
        }

        foreach ($filtersToUpdate as $filter => $property) {
            $value = $this->user->{sprintf('get%s', $property)}();
            $this->{sprintf('set%s', $filter)}($value);
        }
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'created' => 'createdAt',
        );
    }
}

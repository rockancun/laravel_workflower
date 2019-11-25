<?php

namespace App\Participants;

use PHPMentors\Workflower\Workflow\Participant\ParticipantInterface;
use PHPMentors\Workflower\Workflow\Resource\ResourceInterface;

class Reviewer implements ParticipantInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     */
    public function __construct()
    {
        $this->id = 1;
        $this->name = 'dummy-reviewer';
    }

    public function getId()
    {
        return $this->id;
    }

    public function hasRole($role)
    {
        return $role === 'Lane_reviewer';
    }

    public function setResource(ResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getName()
    {
        return $this->name;
    }
}

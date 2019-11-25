<?php


namespace App\Workflow\Entities;

use PHPMentors\Workflower\Persistence\WorkflowSerializableInterface;
use PHPMentors\Workflower\Process\ProcessContextInterface;
use PHPMentors\Workflower\Workflow\Workflow;

class PullRequest implements ProcessContextInterface, WorkflowSerializableInterface
{
    private $id;
    private $title;
    private $approved = false;
    private $merged = false;
    private $workflow;
    private $serializedWorkflow;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function isMerged(): bool
    {
        return $this->merged;
    }

    public function setMerged(bool $merged)
    {
        $this->merged = $merged;
    }

    public function getProcessData()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'approved' => $this->approved,
            'merged' => $this->merged,
            'data' => $this,
        ];
    }

    public function getWorkflow()
    {
        return $this->workflow;
    }

    public function setWorkflow(Workflow $workflow)
    {
        $this->workflow = $workflow;
    }

    public function setSerializedWorkflow($serializedWorkflow)
    {
        $this->serializedWorkflow = $serializedWorkflow;
    }

    public function getSerializedWorkflow()
    {
        if (is_resource($this->serializedWorkflow)) {
            return stream_get_contents($this->serializedWorkflow, -1, 0);
        }

        return $this->serializedWorkflow;
    }

    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved)
    {
        $this->approved = $approved;
    }

    public function __toString()
    {
        return print_r($this->getProcessData(), true);
    }
}

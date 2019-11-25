<?php

namespace App\Usecase;

use App\Participants\Dev;
use App\Workflow\Entities\PullRequest;
use PHPMentors\Workflower\Process\Process;
use PHPMentors\Workflower\Process\WorkItemContext;
use PHPMentors\Workflower\Process\ProcessAwareInterface;

class FixPullRequestUsecase implements ProcessAwareInterface
{

    public function setProcess(Process $process)
    {
        $this->process = $process;
    }

    public function run(PullRequest $pullRequest)
    {
        $dev = new Dev();

        $workItem = new WorkItemContext($dev);
        $workItem->setProcessContext($pullRequest);
        $workItem->setActivityId($pullRequest->getWorkflow()->getCurrentFlowObject()->getId());
        $this->process->allocateWorkItem($workItem);
        $this->process->startWorkItem($workItem);
        $this->process->completeWorkItem($workItem);

        return $pullRequest;
    }
}

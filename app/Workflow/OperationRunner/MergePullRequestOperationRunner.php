<?php

namespace App\Workflow\OperationRunner;

use App\Models\PullRequest;
use App\Participants\Reviewer;
use PHPMentors\Workflower\Workflow\Operation\OperationalInterface;
use PHPMentors\Workflower\Workflow\Operation\OperationRunnerInterface;
use PHPMentors\Workflower\Workflow\Workflow;

class MergePullRequestOperationRunner implements OperationRunnerInterface
{
    public function provideParticipant(OperationalInterface $operational, Workflow $workflow)
    {
        return new Reviewer();
    }

    public function run(OperationalInterface $operational, Workflow $workflow)
    {
        $processData = $workflow->getProcessData();
        $pullRequest = PullRequest::findOrFail($processData['id']);
        $pullRequest->merged = true;


        $pullRequest->save();
    }
}

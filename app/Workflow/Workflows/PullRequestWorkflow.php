<?php

namespace App\Workflow\Workflows;

use PHPMentors\Workflower\Process\WorkflowContextInterface;

class PullRequestWorkflow implements WorkflowContextInterface
{
    public function getWorkflowId()
    {
        return "PullRequestProcess.bpmn";
    }
}

<?php

namespace Tests\Unit;

use App\Workflow\Exceptions\UnsupportedMethodException;
use App\Workflow\Exceptions\WorkflowException;
use App\Workflow\Repository\WorkflowRepository;
use PHPMentors\Workflower\Workflow\Workflow;
use Tests\TestCase;

class WorkflowRepositoryTest extends TestCase
{
    /** @test */
    public function findByIdTest()
    {
        try {
            $repository = new WorkflowRepository();
            $workflow = $repository->findById("PullRequestProcess.bpmn");
            $this->assertInstanceOf(Workflow::class, $workflow);
        } catch (Exception $e) {

        }
    }

    /** @test */
    public function findByIdThrowExceptionTest()
    {
        try {
            $repository = new WorkflowRepository();
            $workflow = $repository->findById("Error");
        } catch (WorkflowException $e) {
            $this->assertInstanceOf(WorkflowException::class, $e);
        }
    }

    /** @test */
    public function addTest()
    {
        $repository = new WorkflowRepository();
        try {
            $repository->add(null);
        } catch (UnsupportedMethodException $e) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function removeTest()
    {
        $repository = new WorkflowRepository();
        try {
            $repository->remove(null);
        } catch (UnsupportedMethodException $e) {
            $this->assertTrue(true);
        }
    }
}

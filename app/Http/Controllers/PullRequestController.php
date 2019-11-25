<?php

namespace App\Http\Controllers;

use App\Models\PullRequest;
use App\Usecase\CreatePullRequestUsecase;
use App\Usecase\FixPullRequestUsecase;
use App\Usecase\ReviewPullRequestUsecase;
use App\Workflow\Entities\ConverterModelToWorkflowEntity;
use App\Workflow\Entities\PullRequest as PullRequestEntity;
use App\Workflow\OperationRunner\MergePullRequestOperationRunner;
use App\Workflow\Repository\WorkflowRepository;
use App\Workflow\Workflows\PullRequestWorkflow;
use Illuminate\Http\Request;
use PHPMentors\Workflower\Persistence\PhpWorkflowSerializer;
use PHPMentors\Workflower\Process\Process;

class PullRequestController extends Controller
{
    public function index()
    {
        $pullRequests = PullRequest::all();
        return view('index', compact('pullRequests'));
    }

    public function getCreatePullRequest(PullRequest $pullRequest)
    {
        return view("create", compact('pullRequest'));
    }

    public function postCreatePullRequest(Request $request)
    {
        $model = $this->makeModelPullRequest($request);
        $entity = $this->convertModelToEntity($model);
        $entityUpdated = $this->executeCreateUseCase($entity);

        $this->savePullRequest($model, $entityUpdated);

        return redirect()->route('index');
    }

    public function getReviewPullRequest($id)
    {
        $pull_request = PullRequest::findOrFail($id);
        return view("review", compact('pull_request'));
    }

    public function postReviewPullRequest(Request $request)
    {
        $model = PullRequest::findOrFail($request->id);
        $model->approved = $request->approved;
        $entity = $this->convertModelToEntity($model);
        $entityUpdated = $this->executeReviewUseCase($entity);

        $this->savePullRequest($model, $entityUpdated);

        return redirect()->route('index');
    }

    public function getFixPullRequest($id)
    {
        $pull_request = PullRequest::findOrFail($id);
        return view("fix", compact('pull_request'));
    }

    public function postFixPullRequest(Request $request)
    {
        $model = PullRequest::findOrFail($request->id);
        $entity = $this->convertModelToEntity($model);
        $entityUpdated = $this->executeFixUseCase($entity);

        $this->savePullRequest($model, $entityUpdated);

        return redirect()->route('index');
    }

    private function makeModelPullRequest($request)
    {
        $pullRequest = new PullRequest();
        $pullRequest->title = $request->title;
        $pullRequest->merged = false;
        $pullRequest->approved = false;
        return $pullRequest;
    }

    private function executeCreateUseCase($entity)
    {
        $usecase = new CreatePullRequestUsecase();
        $usecase->setProcess($this->createProcess());
        $entity = $usecase->run($entity);
        return $entity;
    }

    private function executeReviewUseCase($entity)
    {
        $usecase = new ReviewPullRequestUsecase();
        $usecase->setProcess($this->createProcess());
        $entity = $usecase->run($entity);

        return $entity;
    }

    private function executeFixUseCase($entity)
    {
        $usecase = new FixPullRequestUsecase();
        $usecase->setProcess($this->createProcess());
        $entity = $usecase->run($entity);

        return $entity;
    }

    private function convertModelToEntity($model)
    {
        $converter = new ConverterModelToWorkflowEntity();
        return $converter->convertModelToEntity($model);
    }

    private function createProcess()
    {
        $repository = new WorkflowRepository();
        $pullRequestWorkflow = new PullRequestWorkflow();
        $operationRunner = new MergePullRequestOperationRunner();
        $process = new Process($pullRequestWorkflow, $repository, $operationRunner);

        return $process;
    }

    private function savePullRequest(PullRequest $pullRequest, PullRequestEntity $pullRequestWorkflow)
    {
        $serializer = new PhpWorkflowSerializer();

        $pullRequest->title = $pullRequestWorkflow->getTitle();
        $pullRequest->approved = $pullRequestWorkflow->isApproved();
        $workflow = $pullRequestWorkflow->getWorkflow();
        $pullRequest->state = $workflow->getCurrentFlowObject()->getId();
        $pullRequest->serialized_workflow = $serializer->serialize($workflow);

        $pullRequest->save();
    }
}

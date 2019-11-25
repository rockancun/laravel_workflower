<?php

namespace App\Workflow\Repository;

use App\Workflow\Exceptions\UnsupportedMethodException;
use App\Workflow\Exceptions\WorkflowException;
use Log;
use PHPMentors\Workflower\Definition\Bpmn2Reader;
use PHPMentors\Workflower\Workflow\Workflow;
use PHPMentors\Workflower\Workflow\WorkflowRepositoryInterface;
use Storage;
use App\Workflow\Entities\ConverterModelToWorkflowEntity;

class WorkflowRepository implements WorkflowRepositoryInterface
{
    private $filePath;
    private $bpmnReader;

    public function __construct()
    {
        $this->bpmnReader = new Bpmn2Reader();
    }

    public function findById($filePath):  ? Workflow
    {
        try {
            $this->filePath = $filePath;
            return $this->readFileWithBpmReaderAndReturnWorkflow();
        } catch (\Exception $e) {
            Log::error($e);
            throw new WorkflowException("Error en la lectural del archivo en workflower", 1);
        }
    }

    private function readFileWithBpmReaderAndReturnWorkflow()
    {
        return $this->bpmnReader->read($this->getStorageFilePath());
    }

    private function getRelativeFilePath()
    {
        return "process/{$this->filePath}";
    }

    private function getStorageFilePath()
    {
        return Storage::path(
            $this->getRelativeFilePath()
        );
    }

    public function add($workflow) : void
    {
        throw new UnsupportedMethodException("Metodo no necesario para la implementacion", 1);
    }

    public function remove($workflow): void
    {
        throw new UnsupportedMethodException("Metodo no necesario para la implementacion", 1);
    }
}

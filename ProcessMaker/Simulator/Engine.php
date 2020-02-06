<?php

namespace ProcessMaker\Simulator;

use ProcessMaker\Models\Process;
use ProcessMaker\Models\ProcessRequest;
use ProcessMaker\Nayra\Contracts\Engine\EngineInterface;
use ProcessMaker\Nayra\Contracts\EventBusInterface;
use ProcessMaker\Nayra\Contracts\RepositoryInterface;
use ProcessMaker\Nayra\Engine\EngineTrait;

/**
 * Test implementation for EngineInterface.
 *
 * @package ProcessMaker
 */
class Engine implements EngineInterface
{
    use EngineTrait;

    /**
     * @var RepositoryFactoryInterface
     */
    private $repository;

    /**
     * @var EventBusInterface $dispatcher
     */
    private $dispatcher;

    /**
     * Process definition row.
     *
     * @var \ProcessMaker\Model\Process
     */
    private $process;

    /**
     * Test engine constructor.
     *
     * @param RepositoryInterface $repository
     * @param EventBusInterface $dispatcher
     */
    public function __construct(RepositoryInterface $repository, $dispatcher)
    {
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return EventBusInterface
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * @param EventBusInterface $dispatcher
     *
     * @return $this
     */
    public function setDispatcher(EventBusInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

    /**
     * @return RepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param RepositoryInterface $repository
     *
     * @return $this
     */
    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return Model\Process
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * @param RepositoryInterface $repository
     *
     * @return $this
     */
    public function setProcess(Process $process)
    {
        $this->process = $process;
        return $this;
    }

    /**
     * Load an execution instance from an external storage.
     *
     * @param ProcessRequest $instance
     *
     * @return ExecutionInstanceInterface|null
     */
    public function loadProcessRequest(ProcessRequest $instance)
    {
        // If exists return the already loaded instance by id
        foreach ($this->executionInstances as $executionInstance) {
            if ($executionInstance->getId() === $instance->getKey()) {
                return $executionInstance;
            }
        }
        $parentStorage = $this->getStorage();
        $this->setStorage($instance->process->getDefinitions(false, $this));
        $instance = $this->loadExecutionInstance($instance->getKey());
        $this->setStorage($parentStorage);
        return $instance;
    }
}

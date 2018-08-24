<?php
namespace ProcessMaker\Jobs;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Model\Process as Definitions;
use ProcessMaker\Nayra\Contracts\Bpmn\EventInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ProcessInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface;
use Throwable;

class StartEvent extends BpmnAction
{

    public $definitionsId;
    public $processId;
    public $eventId;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Definitions $definitions, StartEventInterface $event, array $data)
    {
        $this->definitionsId = $definitions->id;
        $this->processId = $event->getOwnerProcess()->getId();
        $this->eventId = $event->getId();
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //try {
            //Load the process definition
            $definitions = Definitions::find($this->definitionsId);
            $workflow = $definitions->getDefinitions();

            //Get the reference to the process
            $process = $workflow->getProcess($this->processId);

            //Get the reference to the event
            $event = $workflow->getEvent($this->eventId);

            //Do the action
            $response = App::call([$this, 'action'], compact('workflow', 'process', 'event'));

            //Run engine to the next state
            $workflow->getEngine()->runToNextState();
            
            return $response;
        //} catch (Throwable $t) {
        //    Log::error($t->getMessage());
        //}
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function action(ProcessInterface $process, EventInterface $event)
    {
        //Create a new data store
        $dataStorage = $process->getRepository()->createDataStore();
        $dataStorage->setData($this->data);
        $instance = $process->getEngine()->createExecutionInstance($process, $dataStorage);
        $event->start();
        
        //Sending message
        return $instance;
    }
}

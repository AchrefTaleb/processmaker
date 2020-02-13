<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\Shared\LoggingHelper;
use ProcessMaker\Events\ActivityAssigned;
use ProcessMaker\Events\ActivityCompleted;
use ProcessMaker\Events\ProcessCompleted;
use ProcessMaker\Events\ProcessUpdated;
use ProcessMaker\Models\ProcessRequestToken as Task;
use ProcessMaker\Models\ProcessRequest as Request;
use Illuminate\Foundation\Testing\WithFaker;

class BroadcastTest extends TestCase
{
    use LoggingHelper, WithFaker;

    public function testBroadcastEventsHaveTesting()
    {
        $path = app_path('Events');
        $files = scandir($path);
        foreach ($files as $file) {
            $doesMatch = preg_match('/(?<name>.+).php/', $file, $matches);
            if ($doesMatch) {
                $name = $matches['name'];
                $methodName = "test{$name}Broadcast";
                $this->assertTrue(method_exists($this, $methodName), "Failed asserting that broadcast event $name has a test.");
            }
        }
    }

    /**
     * Asserts that the ActivityAssigned broadcast event works.
     *
     * @return void
     */
    public function testActivityAssignedBroadcast()
    {
        $task = factory(Task::class)->create([
            'data' => [
                'test' => $this->faker->text(20000),
            ]
        ]);
        
        event(new ActivityAssigned($task));
        $this->assertLogContainsText('ActivityAssigned');
        $this->assertLogContainsText(addcslashes(route('api.tasks.show', ['task' => $task->id]), '/'));
        $this->assertBroadcastEventSizeLessThan('ActivityAssigned', 10000);
    }

     /**
     * Asserts that the ActivityCompleted broadcast event works.
     *
     * @return void
     */
    public function testActivityCompletedBroadcast()
    {
        $task = factory(Task::class)->create([
            'data' => [
                'test' => $this->faker->text(20000),
            ]
        ]);
        event(new ActivityCompleted($task));
        $this->assertLogContainsText('ActivityCompleted');
        $this->assertLogContainsText(addcslashes(route('api.tasks.show', ['task' => $task->id]), '/'));
        $this->assertBroadcastEventSizeLessThan('ActivityCompleted', 10000);
    }

     /**
     * Asserts that the ProcessCompleted broadcast event works.
     *
     * @return void
     */
    public function testProcessCompletedBroadcast()
    {
        $request = factory(Request::class)->create([
            'data' => [
                'test' => $this->faker->text(20000),
            ]
        ]);
        event(new ProcessCompleted($request));
        $this->assertLogContainsText('ProcessCompleted');
        $this->assertLogContainsText(addcslashes(route('api.requests.show', ['task' => $request->id]), '/'));
        $this->assertBroadcastEventSizeLessThan('ProcessCompleted', 10000);
    }

    /**
     * Asserts that the ProcessUpdated broadcast event works.
     *
     * @return void
     */
    public function testProcessUpdatedBroadcast()
    {
        $request = factory(Request::class)->create([
            'data' => [
                'test' => $this->faker->text(20000),
            ]
        ]);
        event(new ProcessUpdated($request, 'ACTIVITY_COMPLETED'));
        $this->assertLogContainsText('ProcessUpdated');
        $this->assertLogContainsText(addcslashes(route('api.requests.show', ['task' => $request->id]), '/'));
        $this->assertBroadcastEventSizeLessThan('ProcessUpdated', 10000);
    }
}
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertNotEmpty;

class TaskTest extends TestCase
{

    public function test_store_task(){
        $task = Task::factory()->make();
        $response = $this->postJson(route('tasks.store'),['title'=>$task->title])
            ->assertCreated()
            ->json(); 
        assertNotEmpty($response);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_tasks()
    {
       $task = Task::factory()->create();
       $response = $this->getJson(route('tasks.index'))
                    ->assertOk()
                    ->json();
       assertGreaterThan(0,count($response));
    }

    public function test_task_delete()
    {
        $task = Task::factory()->create();
        $this->deleteJson(route('tasks.destroy', $task->id))
            ->assertNoContent();
        $this->assertDatabaseMissing('tasks',['title'=>$task->title]);
        
    }
}

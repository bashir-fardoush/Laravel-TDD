<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class TodoListTest extends TestCase
{

    private $list;
    public function setUp(): void
    {
        parent::setUp();
        $this->list = TodoList::factory()->create(['name'=>'Goto Umar Nana Bari']);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_todo_lists()
    {
        $response = $this->getJson(route('todo-list.index'));
        $response->assertStatus(200);
        assertEquals(1, count($response->json()));
    }

    public function test_fetch_single_todo_list(){
        $response = $this->getJson(route('todo-list.show', $this->list->id));
        $response->assertOk();
        assertEquals('Goto Umar Nana Bari', $response->json()['name']);
    }

    public function test_store_new_todo_list(){
        $todoList = TodoList::factory()->make();
        $response = $this->postJson(route('todo-list.store', ['name'=> $todoList->name, 'description'=>$todoList->description]));
        $response->assertCreated();
        $this->assertDatabaseHas('todo_lists',['name'=>$todoList->name]);
    }

    public function test_store_todo_name_is_required(){
        $this->withExceptionHandling();
        $this->postJson(route('todo-list.store'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);        
    }
    public function test_update_todo_name_is_required(){
        $this->withExceptionHandling();
        $this->patchJson(route('todo-list.update', $this->list->id))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);        
    }

    public function test_update_todo_list(){
        $this->patchJson(route('todo-list.update',$this->list->id),['name'=>'Updated todo Title'])
        ->assertOk()
        ->json();
        $this->assertDatabaseHas('todo_lists',['name'=>'Updated todo Title']);

    }

    public function test_todo_list_delete(){
        $this->deleteJson(route('todo-list.destroy', $this->list->id))
        ->assertNoContent();
        $this->assertDatabaseMissing('todo_lists', ['name'=>$this->list->name]);
    }

}

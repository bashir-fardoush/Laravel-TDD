<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class TodoListTest extends TestCase
{

    //private $list;
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
        $response = $this->getJson(route('todo-list.list'));
        $response->assertStatus(200);
        assertEquals(1, count($response->json()));
    }

    public function test_fetch_single_todo_list(){
      //  TodoList::factory()->create(['name'=>'Goto Umar Nana Bari']);

        $response = $this->getJson(route('todo-list.show', 1));
        $response->assertOk();
        assertEquals('Goto Umar Nana Bari', $response->json()['name']);
    }

    public function test_store_new_todo_list(){
        $todoList = TodoList::factory()->make();
        $response = $this->postJson(route('todo-list.store', ['name'=> $todoList->name, 'description'=>$todoList->description]));
        $response->assertCreated();
        $this->assertDatabaseHas('todo_lists',['name'=>$todoList->name]);
    }
}

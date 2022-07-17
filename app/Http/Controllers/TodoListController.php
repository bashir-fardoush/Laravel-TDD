<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class TodoListController extends Controller
{
    
    public function index(){
        $lists = TodoList::all();
        return response($lists);
    }

    public function store(TodoListRequest $request){

      $list =  TodoList::create($request->all());
      return response($list, HttpFoundationResponse::HTTP_CREATED);

    }

    public function show($id){

       return TodoList::findOrFail($id);

    }

    public function update(TodoListRequest $request, TodoList $todo_list)
    {
       $todo_list->update($request->all());
       return response($todo_list,HttpFoundationResponse::HTTP_OK);
    }

    public function destroy(TodoList $todo_list){
      $todo_list->delete();
      return response('',HttpFoundationResponse::HTTP_NO_CONTENT);
    }
}

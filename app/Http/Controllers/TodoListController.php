<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class TodoListController extends Controller
{
    
    public function index(){
        $lists = TodoList::all();
        return response($lists);
    }

    public function store(Request $request){

      $request->validate([
        'name' => ['required'],
        'description' => ['required'],
      ]);

      $list =  TodoList::create($request->all());
      return response($list, HttpFoundationResponse::HTTP_CREATED);

    }

    public function show($id){

       return TodoList::findOrFail($id);

    }

    public function update(Request $request, TodoList $list)
    {
      $request->validate([
        'name'=> ['required']
      ]);
       $list->update($request->all());
       return response($list,HttpFoundationResponse::HTTP_OK);
    }

    public function destroy(TodoList $list){
      $list->delete();
      return response('',HttpFoundationResponse::HTTP_NO_CONTENT);
    }
}

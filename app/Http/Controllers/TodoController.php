<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo ; 

class TodoController extends Controller
{
    
    public function index(Request $request){
    

        $all_todos = Todo::all(); 
        $editTodo = null ; 

        if($request->has('edit')){
            $editTodo = Todo::find($request->edit);

        };

        return view('todos.index' , compact("all_todos" , "editTodo")) ; 

    }


    public function create(Request $request){

        $validated = $request->validate([
            'title'=>'required|string|max:255' , 
            'description'=>"nullable|string" , 
            'priority'=>"nullable|in:low,medium,high",
            "due_date"=>"nullable|date",
        ]) ; 

        Todo::create([
            'title'=>$validated['title'] ,
            'description'=>$validated['description'] ?? null  , 
            'priority'=>$validated['priority'] ?? "medium" , 
            "due_date"=>$validated['due_date'] ?? null , 
        ]) ; 


        return redirect()->back();


    }

    public function destroy($id){

        $target_todo = Todo::find($id) ; 
        $target_todo->delete() ; 


        return redirect()->back() ; 

    }


    public function update(Request $request,$id){

            $target_todo  = Todo::find($id) ; 
            $validated = $request->validate([
                'title'=>'required|string|max:255'  , 
                'description'=>'nullable|string' ,
                'priority'=>'nullable|in:low,medium,high' , 
                "due_date"=>'nullable|date' , 
            ]) ; 


            $target_todo->update($validated);

            return redirect()->route('todos.index') ; 

    }


    public function toggle($id){

        $target_todo = Todo::find($id) ; 
        $target_todo->status  = ($target_todo->status== "pending") ?  "completed" : "pending" ; 
        $target_todo->save() ; 
        
        return back() ; 

    }

}

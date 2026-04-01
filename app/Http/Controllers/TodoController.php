<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo  ;

class TodoController extends Controller
{
    

    public function index(){

        $todos  =  Todo::all();
        return view("todos.index") ; 


    } 


    public function  store(Request $request){

        $requestData = $request->only(['title', "description"]) ; 

        Todo::create([
            'title'=> $requestData['title'] , 
            'description'=> $requestData['descriptoin'] 
        ]) ; 

    }


    public function update( Request $request,$id){

        $targetTodo =  Todo::find($id) ; 
        $targetTodo->update([

                'titile'=> $request->title , 
                'description'=> $request->description 

        ]) ; 


    }

    public function destroy($id){

        $targetTodo = Todo::find($id) ; 
        $todo->delete()

    }

    public function toggleComplete($id){

        $todo = Todo::find($id) ; 
        $todo->is_completed = !$todo->is_completed; 
        $todo->save();


    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function index(Request $request)
    {
        $todo = Auth::user()->todo()->paginate(10);
        return response()->json(['status' => 'success','result' => $todo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'todo' => 'required',
        'description' => 'required',
        'category' => 'required'
         ]);
        if(Auth::user()->todo()->Create($request->all())){
            return response()->json(['status' => 'todo has been created successfully']);
        }else{
            return response()->json(['status' => 'fail']);
        }

    }

    public function show($id)
    {
        $todo = Todo::where('id', $id)->get();
        return response()->json($todo);

    }

    public function edit($id)
    {
        $todo = Todo::where('id', $id)->get();
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'todo' => 'filled',
        'description' => 'filled',
        'category' => 'filled'
         ]);
        $todo = Todo::find($id);
        if($todo->fill($request->all())->save()){
           return response()->json(['status' => 'todo has been updated successfully']);
        }
        return response()->json(['status' => 'failed']);
    }

    public function destroy($id)
    {
        if(Todo::destroy($id)){
             return response()->json(['status' => 'todo has been deleted successfully']);
        }
    }
}

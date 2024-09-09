<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class TaskController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Task::with('user:name,id')
        ->filter($request->query())
        ->latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              =>'required|string|min:3|max:255',
            'description'       =>'nullable|string',
        ]);

        $task = Task::create([
            'name'                  =>$request->name,
            'description'           =>$request->description ?? null,
            'user_id'               =>2
        ]);

        return response()->json([
            'task_name'             =>$task->name,
            'description'           =>$task->description,
            'human_readable_time'     =>$task->human_readable_time,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('user:id,name');

        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name'              =>'required|string|min:3|max:255',
            'description'       =>'nullable|string',
        ]);

        $task = Task::where('name',$task->name)->update([
            'name'                  =>$request->name,
            'description'           =>$request->description ?? null,
            'user_id'               =>2
        ]);

        return response([
            'message'                   =>"$task->name updated successfully"
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null,204);
    }
}

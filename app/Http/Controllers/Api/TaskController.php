<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(){
        return [
            new Middleware('auth:sanctum',except:['index','show']),
        ];
    }

    public function index(Request $request)
    {
        $task = Task::with('user')
        ->filter($request->query())
        ->latest()->paginate(5);

        return TaskResource::collection($task);
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

        return new TaskResource($task);
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
            'name'              =>'sometimes|required|string|min:3|max:255',
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

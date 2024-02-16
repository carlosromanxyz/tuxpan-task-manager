<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all tasks
        $tasks = Task::all();

        // If no tasks were found return a message
        if ($tasks->count() === 0) {
            return response()->json([
                'message' => 'No tasks found'
            ]);
        }

        // Return the tasks
        return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If the task was created successfully return a success message and the created task details
        return response()->json([
            'message' => 'Task created successfully',
            'task' => Task::create([
                'title' => request('title'),
                'description' => request('description'),
            ])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Return the task
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Update the task with the request data
        $task->update([
            'title' => request('title'),
            'description' => request('description'),
        ]);

        // If the task was updated successfully return a success message and the updated task
        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();

        // If the task was deleted successfully return a success message
        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}

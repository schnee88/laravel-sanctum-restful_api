<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if (!auth()->user)

        $validate = $request->validate([
            'title' => 'reqired|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $task = Task::create($validated);
        
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $task = Task::findOrFail($id);

        // Validācija
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}

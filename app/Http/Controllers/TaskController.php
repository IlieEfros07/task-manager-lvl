<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function index()
    {
        $user = Auth::user(); 


        $tasks = Task::where('status', 'public')
                     ->orWhere('user_id', $user->id)
                     ->with('user') 
                     ->latest() 
                     ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
         return view('tasks.create');
    }


    public function store(Request $request)
    {


        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['public', 'private'])],
        ]);

        $task = Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.index')
                     ->with('success', 'Task creat cu succes!');
    }


    public function show(Task $task)
    {

        $this->authorize('view', $task);



        return view('tasks.show', compact('task'));
    }


    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
         $this->authorize('update', $task);

         $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['public', 'private'])],
        ]);

         $task->update($validated);

         return redirect()->route('tasks.show', $task)
                      ->with('success', 'Task actualizat cu succes!');
    }


    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
                     ->with('success', 'Task șters cu succes!');
    }
}
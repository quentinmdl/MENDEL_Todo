<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Renvoi une vue à laquelle on transmet les tasks de l'utilisateurs (ceux auxquels il participe)
        $user = Auth::user();
        return view('tasks.index', ['user' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Permet de stocker une nouvelle task pour l'utilisateur dans la base de données
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'max:4096',
            'state' => 'required|string|max:255'
        ]);
        $task = new Task(); 
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->state = $validatedData['state'];
        $task->user_id = Auth::user()->id; 

        $task->save(); 
        return redirect('/tasks');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $user)
    {
        //
        return view('tasks.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $user)
    {
        //
        $validatedData = $request->validate([
                'title' => 'required|string|max:255', 
                'description' => 'max:4096',
                'state' => 'required|string|max:255'
            ]
        );
        $task->title = $validatedData['title']; 
        $task->description = $validatedData['description'];
        $task->state = $validatedData['state']; 
        $task->update(); 

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $board->delete();
        return redirect('/tasks');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardUserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Renvoi une vue à laquelle on transmet les boards de l'utilisateurs (ceux auxquels il participe)
        $user = Auth::user();
        //return view('boards.index', ['user' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('boardsusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Permet de stocker un nouveau board pour l'utilisateur dans la base de données
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'max:4096'
        ]);
        $board = new Board(); 
        $board->title = $validatedData['title'];
        $board->description = $validatedData['description'];
        $board->user_id = Auth::user()->id; 

        $board->save(); 
        return redirect('/boardsusers');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //return view('boards.show', ['board' => $board]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $user)
    {
        //
        return view('boardsusers.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $user)
    {
        //
        $validatedData = $request->validate([
                'title' => 'required|string|max:255', 
                'description' => 'max:4096'
            ]
        );
        $board->title = $validatedData['title']; 
        $board->description = $validatedData['description']; 
        $board->update(); 

        return redirect('/boardsusers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $user)
    {
        //
        $board->delete();
        return redirect('/boardsusers');
    }
}

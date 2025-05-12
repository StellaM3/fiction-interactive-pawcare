<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CreateStoryController extends Controller
{
    //if logged as admin, show the create story form
    public function create()
    {
        
        if (Session::has('user_id') && Session::get('user_id') === 2) {
            return view('createStory');
        } 
        return redirect('/login')->with('error', 'Accès réservé aux administrateurs');
    
    }
    //store the story in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Assuming you have a Story model
        $story = new \App\Models\Story();
        $story->title = $validated['title'];
        $story->content = $validated['content'];
        $story->user_id = auth()->id(); // Assuming the user is logged in
        $story->save();

        return redirect('/')->with('success', 'Story created successfully.');
    }


}

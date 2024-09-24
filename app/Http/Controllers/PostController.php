<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $userInputs = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $userInputs['title'] = strip_tags($userInputs['title']);
        $userInputs['body'] = strip_tags($userInputs['body']);
        $userInputs['user_id'] = auth()->id();

        //save to database.. model
        Post::create($userInputs);
        return redirect('/');

    }

    public function showEditScreen(Post $post){
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $userInputs = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $userInputs['title'] = strip_tags($userInputs['title']);
        $userInputs['body'] = strip_tags($userInputs['body']);

        $post->update($userInputs);
        return redirect('/');

    }

    public function deletePost(Post $post){
        if (auth()->user()->id === $post['user_id']) {
           $post->delete();
        }
        return redirect('/');

    }
}

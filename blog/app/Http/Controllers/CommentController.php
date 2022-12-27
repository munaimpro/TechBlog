<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModel;
use Session;

class CommentController extends Controller
{
    function addcomment($postid, Request $request){
        $comments = new CommentModel();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required|max:1000'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $website = $request->input('website');
        $text = $request->input('text');
        $postid = $postid;
        $userid = Session::get('loginid');

        if($postid){
            $comments->postId = $postid;
            $comments->userId = $userid;
            $comments->userName = $name;
            $comments->text = $text;
            $comments->userEmail = $email;
            $comments->userWebsite = $website;

            $comments->save();

            return back()->with('success', 'Comment submitted successfuly');
        } else{
            return back()->with('fail', 'Session data not found!');
        }

    }

    function removecomment($commentid){
        $comments = CommentModel::find($commentid);
        $result = $comments->delete();
        if($result){
            return back()->with('mancommentsuccess', 'Comment removed successfuly');
        } else{
            return back()->with('mancommentfail', 'Something went wrong!');
        }
    }

    function editcomment($id){
        $comments = CommentModel::find($id);
        return view('techblog.editcomment', compact('comments'));
    }

    function updatecomment($id, Request $request){
        $comments = CommentModel::find($id);

        $request->validate([
            'text' => 'required|max:1000'
        ]);

        $text = $request->input('text');

        $comments->text = $text;

        $result = $comments->update();
        if($result){
            return redirect('techblog/postdetails/'.$comments->postId)->with('mancommentsuccess', 'Comment updated successfuly');
        } else{
            return back()->with('mancommentfail', 'Something went wrong!');
        }
        
    }
}

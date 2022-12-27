<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\File;
use Session;

class PostController extends Controller
{

    function addpost(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') == '0'){
            return redirect('admin/dashboard');
        } else{
            $catlist = CategoryModel::get();
            return view('Admin.addpost', compact('catlist'));
        }
    }

    function insertPost(Request $request){
        $post = new PostModel();

        $request->validate([
            'posttitle'=>'required',
            'postimage'=>'required|image|mimes:jpg,png,jpeg|max:2048',
            'postcategory' => 'required',
            'postcontent' => 'required',
            'posttags' => 'required',
        ]);

        $posttitle = $request->input('posttitle');
        $postcategory = $request->input('postcategory');
        $postcontent = $request->input('postcontent');
        $posttags = $request->input('posttags');
        $poststatus = $request->input('poststatus');
        $postuser = Session::get('loginid');
        
        $category = CategoryModel::find($postcategory);

        if($postuser){
            $post->posttitle = $posttitle;
            $post->catId = $postcategory;
            $post->postcontent = $postcontent;
            $post->posttags = $posttags;
            $post->postedby = $postuser;
            if($poststatus == 1){
            $post->poststatus = $poststatus;
            }
            $category->increment('post');

            if($request->hasfile('postimage')){
                $file = $request->file('postimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/post', $filename);
    
                $post->postImg = $filename;
            }

            $result = $post->save();

            if($result){
                return redirect('admin/posts')->with('success', 'Post added successfully');
            } else{
                return back()->with('fail', 'Something went wrong');
            }
        }
    }

    function editPost($postId){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } else{
            $postbyid = PostModel::find($postId);
            $catlist = CategoryModel::get();
            return view('Admin.editpost', compact('postbyid'), compact('catlist'));
        }
    }

    function updatePost($id, Request $request){
        $post = PostModel::find($id);

        $request->validate([
            'posttitle'=>'required',
            'postimage'=>'image|mimes:jpg,png,jpeg|max:2048',
            'postcategory' => 'required',
            'postcontent' => 'required',
            'posttags' => 'required',
        ]);

        $posttitle = $request->input('posttitle');
        $postcategory = $request->input('postcategory');
        $postcontent = $request->input('postcontent');
        $posttags = $request->input('posttags');
        $poststatus = $request->input('poststatus');
        $postuser = 'Munaim Khan';
        
        $post->posttitle = $posttitle;
        $post->catId = $postcategory;
        $post->postcontent = $postcontent;
        $post->posttags = $posttags;
        $post->postedby = $postuser;
        $post->poststatus = $poststatus;

        if($request->hasfile('postimage')){
            $file = $request->file('postimage');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/post', $filename);

            $destination = 'uploads/post/'.$post->postImg;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $post->postImg = $filename;
        }

        $result = $post->update();

        if($result){
            return redirect('admin/posts')->with('success', 'Post updated successfully');
        } else{
            return back()->with('fail', 'Something went wrong');
        }
    }

    function removePost($id){
        $data = PostModel::find($id);
        $postcategory = $data->catId;
        $category = CategoryModel::find($postcategory);

        $destination = 'uploads/post/'.$data->postImg;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $result = $data->delete();
        $category->decrement('post');

        if($result){
            return redirect('admin/posts')->with('success', 'Post deleted successfully');
        } else{
            return back()->with('fail', 'Something went wrong');
        }
    }
}

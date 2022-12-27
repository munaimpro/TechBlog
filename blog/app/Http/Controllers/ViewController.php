<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use Session;

class ViewController extends Controller
{
    function dashboard(){
        $post = PostModel::count();
        $category = CategoryModel::count();
        $user = UserModel::count();
        $publish = PostModel::where('poststatus','=','1')->get();
        $publish = $publish->count();

        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } else{
            return view('Admin.dashboard', compact(['post', 'category', 'user', 'publish']));
        }
        
    }

    function category(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } else{
            $catlist = CategoryModel::all();
            return view('Admin.catlist', compact('catlist'));
            return view('Admin.postlist', compact('catlist'));
        }
    }

    function post(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } else{
            $post = PostModel::Join('tbl_category', 'tbl_category.id', '=', 'tbl_post.catId')->get(['tbl_post.*', 'tbl_category.catName']);
            return view('Admin.postlist', compact('post'));
        }
    }

    function user(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != '2'){
            return redirect('admin/dashboard');
        } else{
            $user = UserModel::all();
            return view('Admin.userlist', compact('user'));
        }
    }

    function login(){
        if(Session::has('loginid')){
            return redirect('admin/dashboard');
        } else{
            return view('Admin.login');
        }
    }

    function register(){
        if(Session::has('loginid') == true){
            return redirect('admin/dashboard');
        } else{
            return view('Admin.register');
        }
    }

    function password(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } else{
            return view('Admin.password');
        }
    }

    function index(){
        $post = PostModel::Join('tbl_category', 'tbl_category.id', '=', 'tbl_post.catId')->Join('users', 'users.userId', '=', 'tbl_post.postedby')->where('tbl_post.poststatus','=','1')->get(['tbl_post.*', 'tbl_category.catName', 'users.*']);
        return view('Techblog.home', compact(['post']));
    }

    function contact(){
        return view('Techblog.contact');
    }

    function site_category($catid){
        $allcatpost = PostModel::Join('tbl_category', 'tbl_category.id', '=', 'tbl_post.catId')->Join('users', 'users.userId', '=', 'tbl_post.postedby')->where('tbl_post.catId','=',$catid)->where('tbl_post.poststatus','=',1)->get(['tbl_post.id as postid', 'tbl_post.*', 'tbl_category.catName', 'tbl_category.id', 'users.*']);

        $catname = CategoryModel::where('id','=',$catid)->get(['id','catName']);

        return view('Techblog.category', compact(['allcatpost', 'catname']));
    }

    function postdetails($postid){
        $post = PostModel::find($postid)->increment('postview');

        $postbyid = PostModel::Join('tbl_category', 'tbl_category.id', '=', 'tbl_post.catId')->Join('users', 'users.userId', '=', 'tbl_post.postedby')->where('tbl_post.id','=',$postid)->get(['tbl_post.id as postid', 'tbl_post.*', 'tbl_category.catName', 'tbl_category.id', 'users.*']);

        $comments = CommentModel::where('postId','=',$postid)->get();
        
        return view('Techblog.singlepost', compact(['postbyid', 'comments']));

    }

    function loadProfile(){
        $userid = Session::get('loginid');
        $user = DB::table('users')->where('userId','=',$userid)->get();
        return view('admin.profile', compact('user'));
    }

    
}






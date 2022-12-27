<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Support\Facades\File;
use Session;


class CategoryController extends Controller
{
    function addcategory(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != '2'){
            return redirect('admin/dashboard');
        } else{
            return view('Admin.addcategory');
        }
    }

    function insertCategory(Request $request){
        $category = new CategoryModel();

        $request->validate([
            'categoryname'=>'required',
            'categoryimage'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $catName = $request->input('categoryname');
        
        $catcheck = CategoryModel::where('catName','=',$catName)->first();
        if($catcheck == true){
            return back()->with('fail', 'Category exist already');
        } else{
            $category->catName = $catName;

            if($request->hasfile('categoryimage')){
                $file = $request->file('categoryimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/category', $filename);
    
                $category->catImg = $filename;
            }

            $result = $category->save();

            if($result){
                return redirect('admin/category')->with('success', 'Category added successfully');
            } else{
                return back()->with('fail', 'Something went wrong');
            }
        }
    }

    function removeCategory($id){
        $category = CategoryModel::find($id);
        $post = PostModel::find($id);

        $destination = 'uploads/category/'.$category->catImg;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $result = $category->delete();
        if($result){
            return redirect('admin/category')->with('success', 'Category deleted successfully');
        }
        
    }

    function editCategory($editId){
        if(Session::has('loginid') == false || Session::get('loginrole') != '2'){
            return redirect('admin/login');
        } else{
            $catbyid = CategoryModel::find($editId);
            return view('Admin.editcategory', compact('catbyid'));
        }
    }

    function updateCategory(Request $request, $id){
        $category = CategoryModel::find($id);
        
        $request->validate([
            'categoryname'=>'required',
            'categoryimage'=>'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $catName = $request->input('categoryname');
        $category->catName = $catName;

        if($request->hasfile('categoryimage')){
            $file = $request->file('categoryimage');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/category', $filename);

            $destination = 'uploads/category/'.$category->catImg;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $category->catImg = $filename;
        }

        $result = $category->update();

        if($result){
            return redirect('admin/category')->with('success', 'Category updated successfully');
        } else{
            return back()->with('fail', 'Something went wrong');
        }
    }
}

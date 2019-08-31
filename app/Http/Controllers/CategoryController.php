<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolechecker');
    }
    function categoryinsertform(){
      $category_infor = Category::all();
      return view('category.categoryinsertform', compact('category_infor'));
    }

    function categoryinsertformpost(Request $request){
      $request -> validate([
        'categorie_name'=> 'required',
      ],
      [
        'categorie_name.required'=> 'Please Category Name',
      ]);

      Category::insert([
        'categorie_name' => $request-> categorie_name,
        'created_at' => Carbon::now()
      ]);
      return back()->with('status', 'Category Added Successfully');
    }
    function categorydelete($category_id){
        Category::find($category_id)-> delete();
        return back();
    }
    function categoryeditform($category_id){
        $categoris = Category::findOrFail($category_id);
        return view('category/categoryeditform', compact('categoris'));
    }
    function categoryeditformpost(Request $request){
      $request -> validate([
        'categorie_name'=> 'required|alpha',
      ],
      [
        'categorie_name.alpha'=> 'The categorie name may only contain letters.',
      ]);

       Category::find($request -> categorie_id)-> update([
          'categorie_name' => $request-> categorie_name,
       ]);
       return back()-> with('status','Category Edit Successfully');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolechecker');
    }
    function productinsertform(){
      $select_categories = Category::all();
      $select_products = Product::paginate(6);
      return view('product/insertform', compact('select_products', 'select_categories'));
    }
    function productinsertformpost(Request $request)
    {
        $request->validate([
          'category_id' => 'required',
          'product_name'=> 'required',
          'product_price'=> 'required|numeric',
          'product_quantity'=> 'required|numeric',
          'alert_quantity'=>'required|numeric',
          'product_description'=>'required',
        ],
        [
          'product_name.required' => "The Product name may only letters",
          'product_price.required' => "The Product Price name may  letters Or Number",

          'product_price.required' => "The Product Quantity name may only Number",
          'product_price.numeric' => "The Product Quantity name may only Number",

          'product_quantity.required' => "The Product Quantity name may only Number",
          'product_quantity.numeric' => "The Product Quantity name may only Number",

          'alert_quantity.required' => "The Product Alert Quantity name may only Number",
          'alert_quantity.numeric' => "The Product Alert Quantity name may only Number",

          'product_description.required' => "The Product Details may letters",
        ]);

        $productlast_id = Product::insertGetId([
          'categorie_id' => $request->category_id,
          'product_name' => $request->product_name,
          'product_price' => $request->product_price,
          'product_quantity' => $request->product_quantity,
          'product_alert_quantity' => $request->alert_quantity,
          'product_description' => $request->product_description,
          'created_at' => Carbon::now(),
        ]);

        if ($request->hasfile('product_image')) {
          $main_photo = $request-> product_image;
          $image_extension =  $main_photo-> getClientOriginalExtension();
          $image_name = $productlast_id.".".$image_extension;
          image::make($main_photo)->resize(400, 450)->save(base_path('public/upload/product_images/'.$image_name));

            Product::find($productlast_id)->update([
              'product_image' => $image_name,
            ]);
          }
        return back()->with('status','Product Added Successfully');
    }
    function productdelete($product_id)
    {
      if (Product::find($product_id)->product_image != 'defaultimage.png') {
          $iamge_name = Product::find($product_id)->product_image;
          unlink(base_path('public/upload/product_images/'.$iamge_name));
      }
      Product::find($product_id)-> delete();
      return back();
    }
    function productedit($product_id)
    {
      $product_edit =  Product::findOrFail($product_id);
      $categories =  Category::all();
      return view('product.product_edit', compact('product_edit', 'categories'));
    }
    function producteditpost(Request $request){
      Product::find($request->product_id)->update([
        'categorie_id'=> $request->category_id,
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_alert_quantity' => $request->alert_quantity,
        'product_description' => $request->product_description,
      ]);

      if ($request->hasfile('product_image')) {

      if (Product::find($request->product_id)->product_image != 'defaultimage.png') {
        $delete_photo = Product::find($request->product_id)->product_image;
        unlink(base_path('public/upload/product_images/'.$delete_photo));
      }
        $main_photo = $request-> product_image;
        $image_extension =  $main_photo-> getClientOriginalExtension();
        $image_name = $request->product_id.".".$image_extension;
        image::make($main_photo)->resize(400, 450)->save(base_path('public/upload/product_images/'.$image_name));

          Product::find($request->product_id)->update([
            'product_image' => $image_name,
          ]);
        }

      return back()->with('status','Product Edit Successfully');
    }
}

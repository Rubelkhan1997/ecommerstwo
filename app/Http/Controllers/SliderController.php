<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolechecker');
    }
    function sliderinsertform(){
      $sliders = Slider::all();
      return view('slider\sliderinsertform', compact('sliders'));
    }
    function sliderinsertformpost(Request $request){
      $request->validate([
         'slider_name' => 'required',
      ],
      [
        'slider_name.required' => 'Enter the name of the slider',
      ]);

     $image_id = Slider::insertGetId([
        'slider_name' => $request-> slider_name,
        'created_at' => Carbon::now(),
      ]);

      if ($request->hasfile('slider_image')) {
          $main_photo_name =  $request-> slider_image;
          $image_extension = $main_photo_name-> getClientOriginalExtension();
          $validate_extension = array("jpg","png","JPEG","JPG");
          if (in_array($image_extension , $validate_extension)) {
            $image_new_name = $image_id.".".$image_extension;
            Image::make($main_photo_name)->resize(1036,846)->save(base_path('public/upload/slider_images/'.$image_new_name));

            Slider::find($image_id)->update([
              'slider_image' => $image_new_name,
            ]);
          }
          else {
            echo "nai";
          }
      }
      return back()->with('add','Slider Added Successfully');
    }
}

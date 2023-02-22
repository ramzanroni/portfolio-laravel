<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Image;
class HomeSliderController extends Controller
{
    public function homeSlide()
    {
        $homeslide=HomeSlider::find('1');
        return view('admin.home.homeSlider', compact('homeslide'));
    }

    public function updateSlider(Request $request){
        $slider_id=$request->id;
        if($request->file('slider_img')){
            $image=$request->file('slider_img');
            $slider_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(636,852)->save('upload/slider_img/'.$slider_name);
            $save_url='upload/slider_img/'.$slider_name;
            HomeSlider::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'sort_description'=>$request->sort_desc,
                'slider_img'=>$save_url,
                'video_url'=>$request->video_url
            ]);
            $notification = [
                'message' => 'Slider Information & Image Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }else{
            HomeSlider::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'sort_description'=>$request->sort_desc,
                'video_url'=>$request->video_url
            ]);
            $notification = [
                'message' => 'Slider Information Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }
    }
}

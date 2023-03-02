<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    public function aboutPage()
    {
        $aboutData = About::find('1');
        return view('admin.about.about_page', compact('aboutData'));
    }
    public function aboutUpdate(Request $request)
    {
        $about_id = $request->id;
        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $aboutImg_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)
                ->resize(523, 605)
                ->save('upload/about_images/' . $aboutImg_name);
            $save_url = 'upload/about_images/' . $aboutImg_name;
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_desc,
                'about_image' => $save_url,
            ]);
            $notification = [
                'message' => 'About Information & Image Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_desc,
            ]);
            $notification = [
                'message' => 'About Information Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
    public function aboutView()
    {
        $aboutData = About::find('1');
        return view('frontend.about.about', compact('aboutData'));
    }

    public function aboutMultiimage()
    {
        return view('admin.about.multiImage');
    }

    public function store_multiImage(Request $request)
    {
        $images=$request->file('about_image');
        foreach ($images as $multiImage) {
            $aboutImg_name = hexdec(uniqid()) . '.' . $multiImage->getClientOriginalExtension();
            Image::make($multiImage)
                ->resize(220, 220)
                ->save('upload/multi_images/' . $aboutImg_name);
            $save_url = 'upload/multi_images/' . $aboutImg_name;
            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at'=> Carbon::now(),
            ]);
           
        }
        $notification = [
            'message' => 'About Information & Image Update Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function allMultiImage()
    {
        $allMultiImage=MultiImage::all();
        return view('admin.about.allMultiImage', compact('allMultiImage'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Slider;
use App\Models\SubSlider;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getSection()
    {
        $slider = Slider::StatusActive()->orderBy('order_id','DESC')->get()->toArray();
        $subSlider = SubSlider::StatusActive()->orderBy('order_id','DESC')->get()->toArray();
        $gallery = Gallery::getParent()->StatusActive()->orderBy('order_id','ASC')->get()->toArray();
        return view('layouts.front.front',compact('slider','subSlider','gallery'));
    }

    public function getGallery(Request $request)
    {
        $subGallery = Gallery::where('parent',$request->id)->get();
        return response()->json(['data'=>$subGallery->all()],200);
    }
}

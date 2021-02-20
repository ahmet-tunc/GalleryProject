<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SliderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class SliderController extends Controller
{
    public function sliderShow()
    {
        $slider = Slider::orderBy('order_id','ASC')->paginate(8);
        return view('admin.slider', compact('slider'));
    }

    public function sliderAdd(SliderRequest $request)
    {
        $image = $request->file('image');
        if ($image)
        {
            $path = SliderHelper::saveImage($image);
        }

        SliderHelper::setOrderID($request->orderid);

        Slider::create([
            'name' => $request->name,
            'path' => $path[0] . $path[1],
            'order_id'=>$request->orderid,
            'status' => isset($request->status)?1:0
        ]);

        Alert::success('Başarılı', 'Veri kaydetme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.slider');

    }



    public function sliderDelete(Request $request){
        $veri = DB::table('slider')->whereIn('id',$request->id)->get();

        foreach ($veri as $item){
            Storage::delete('public/'.$item->path);
        }
        DB::table('slider')->whereIn('id',$request->id)->delete();

        return response()->json(['status'=>'Başarılı'],200);
    }

    public function sliderChangeStatus(Request $request){
        $slider = Slider::find($request->id);
        $slider->status = $slider->status? 0 : 1;
        $slider->save();

        return response()->json(['status'=>'başarılı'],200);
    }

    public function sliderGetById(Request $request)
    {
        $data = Slider::where('id',$request->id)->get();
        return response()->json(['data'=>$data->all()],200);
    }

    public function sliderUpdate(Request $request)
    {
        SliderHelper::setOrderID($request->orderid);

        $image = $request->file('image');
        $slider = Slider::find($request->id);
        $slider->name = $request->name;
        if ($image){
            Storage::delete('public/'.$slider->path);
            $path = SliderHelper::saveImage($image);
            $slider->path = $path[0].$path[1];
        }
        $slider->status = $request->status?1:0;
        $slider->order_id = $request->orderid;
        $slider->updated_at = now();
        $slider->save();

        Alert::success('Başarılı', 'Veri güncelleme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.slider');
    }

    public function sliderEditOrder(Request $request)
    {
        $trID = $request->trID;
        $currentID = $request->currentID;
        $newID = $request->newID;

        DB::update('Update slider set slider.order_id=? where id=?', [$newID, $trID]);

        if ($currentID < $newID)
        { //1,3
            //2,3
            DB::update('Update slider set slider.order_id=slider.order_id-1 where id<>? and slider.order_id between ? and ?', [$trID, $currentID, $newID]);
        }
        else
        { //3,1
            //1,2
            DB::update('Update slider set slider.order_id=slider.order_id+1 where id<>? and slider.order_id between ? and ?', [$trID, $newID, $currentID]);
        }

        return response()->json(['status'=> 'Başarılı'],200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SliderHelper;
use App\Http\Controllers\Controller;
use App\Models\SubSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SubSliderController extends Controller
{
    public function subSliderShow()
    {
        $subSlider = SubSlider::orderBy('order_id','ASC')->paginate(8);
        return view('admin.subSlider', compact('subSlider'));
    }

    public function subSliderAdd(Request $request)
    {
        $image = $request->file('image');
        if ($image)
        {
            $path = SliderHelper::saveImage($image);
        }

        SliderHelper::setOrderID($request->orderid);

        SubSlider::create([
            'title' => $request->title,
            'path' => $path[0] . $path[1],
            'order_id'=>$request->orderid,
            'status' => isset($request->status)?1:0
        ]);

        Alert::success('Başarılı', 'Veri kaydetme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.subSlider');

    }



    public function subSliderDelete(Request $request){
        $veri = DB::table('subslider')->whereIn('id',$request->id)->get();

        foreach ($veri as $item){
            Storage::delete('public/'.$item->path);
        }
        DB::table('subslider')->whereIn('id',$request->id)->delete();

        return response()->json(['status'=>'Başarılı'],200);
    }


    public function subSliderChangeStatus(Request $request){
        $subSlider = SubSlider::find($request->id);
        $subSlider->status = $subSlider->status? 0 : 1;
        $subSlider->save();

        return response()->json(['status'=>'başarılı'],200);
    }

    public function subSliderGetById(Request $request)
    {
        $data = SubSlider::where('id',$request->id)->get();
        return response()->json(['data'=>$data->all()],200);
    }

    public function subSliderUpdate(Request $request)
    {
        SliderHelper::setOrderID($request->orderid);

        $image = $request->file('image');
        $subSlider = SubSlider::find($request->id);
        $subSlider->title = $request->title;
        if ($image){
            Storage::delete('public/'.$subSlider->path);
            $path = SliderHelper::saveImage($image);
            $subSlider->path = $path[0].$path[1];
        }
        $subSlider->status = $request->status?1:0;
        $subSlider->order_id = $request->orderid;
        $subSlider->updated_at = now();
        $subSlider->save();

        Alert::success('Başarılı', 'Veri güncelleme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.subSlider');
    }

    public function subSliderEditOrder(Request $request)
    {
        $trID = $request->trID;
        $currentID = $request->currentID;
        $newID = $request->newID;

        DB::update('Update subslider set subslider.order_id=? where id=?', [$newID, $trID]);

        if ($currentID < $newID)
        { //1,3
            //2,3
            DB::update('Update subslider set subslider.order_id=subslider.order_id-1 where id<>? and subslider.order_id between ? and ?', [$trID, $currentID, $newID]);
        }
        else
        { //3,1
            //1,2
            DB::update('Update subslider set subslider.order_id=subslider.order_id+1 where id<>? and subslider.order_id between ? and ?', [$trID, $newID, $currentID]);
        }

        return response()->json(['status'=> 'Başarılı'],200);
    }
}

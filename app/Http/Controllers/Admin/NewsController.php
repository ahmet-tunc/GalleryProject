<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SliderHelper;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    public function newsShow()
    {
        $news = News::paginate(8);
        return view('admin.news', compact('news'));

    }

    public function newsAddShow()
    {
        return view('admin.add_news');
    }

    public function newsAdd(Request $request)
    {
        $image = $request->file('image');
        if ($image)
        {
            $path = SliderHelper::saveImage($image);
        }
        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->text,
            'path' => $path[0] . $path[1],
            'slug' => Str::slug($request->title, '-'),
            'status' => isset($request->status) ? 1 : 0
        ]);

        Alert::success('Başarılı!','"'.$request->title.'" adlı haber yazısı başarıyla kaydedilmiştir.');
        return redirect()->route('admin.news');
    }

    public function newsGetById($id)
    {
        if (isset($id)){
            $news = News::find($id)->first();
            return view('admin.add_news',compact('news'));
        }
    }

    public function newsUpdate(Request $request)
    {
        $image = $request->file('image');
        $news = News::find($request->id);
        $news->title = $request->title;
        if ($image)
        {
            Storage::delete('public/' . $news->path);
            $path = SliderHelper::saveImage($image);
            $news->path = $path[0] . $path[1];
        }
        $news->status = isset($request->status) ? 1 : 0;
        $news->content = $request->text;
        $news->description = $request->description;
        $news->updated_at = now();
        $news->save();

        Alert::success('Başarılı', 'Veri güncelleme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.news');
    }

    public function newsDelete(Request $request)
    {
        $veri = DB::table('news')->whereIn('id',$request->id)->get();

        foreach ($veri as $item){
            Storage::delete('public/'.$item->path);
        }
        DB::table('news')->whereIn('id',$request->id)->delete();

        return response()->json(['status'=>'Başarılı'],200);
    }

    public function newsChangeStatus(Request $request)
    {
        $news = News::find($request->id);
        $news->status = $news->status? 0 : 1;
        $news->save();

        return response()->json(['status'=>'başarılı'],200);
    }
}

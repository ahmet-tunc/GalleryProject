<?php

namespace App\Http\Controllers\Admin;

use App\Helper\SliderHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function galleryShow()
    {
        $gallery = Gallery::orderBy('order_id', 'ASC')->GetParent()->paginate(8);
        return view('admin.gallery', compact('gallery'));
    }

    public function galleryAdd(GalleryRequest $request)
    {
        $image = $request->file('image');
        if ($image)
        {
            $path = SliderHelper::saveImage($image);
        }
        Gallery::create([
            'name' => $request->name,
            'description' => $request->description,
            'path' => $path[0] . $path[1],
            'order_id' => $request->orderid,
            'parent' => isset($request->parentCheck) || $request->parentSelect == -1 ? 0 : $request->parentSelect,
            'status' => isset($request->status) ? 1 : 0,
        ]);
        Alert::success('Başarılı!', $request->name . ' adlı galeri başarıyla oluşturuldu.');

        return redirect()->route('admin.gallery');
    }

    public function galleryChangeStatus(Request $request)
    {
        $gallery = Gallery::find($request->id);
        $gallery->status = $gallery->status ? 0 : 1;
        $gallery->save();

        return response()->json(['status' => 'başarılı'], 200);
    }


    public function galleryDelete(Request $request)
    {
        $veri = DB::table('gallery')->whereIn('id', $request->id)->get();

        foreach ($veri as $item)
        {
            Storage::delete('public/' . $item->path);
        }
        DB::table('gallery')->whereIn('id', $request->id)->delete();

        $altVeri = DB::table('gallery')->whereIn('parent', $request->id)->get();
        foreach ($altVeri as $item)
        {
            Storage::delete('public/' . $item->path);
        }
        DB::table('gallery')->whereIn('parent', $request->id)->delete();

        return response()->json(['status' => 'Başarılı'], 200);
    }

    public function galleryGetById(Request $request)
    {
        $data = Gallery::where('id', $request->id)->get();
        return response()->json(['data' => $data->all()], 200);
    }

    public function galleryUpdate(Request $request)
    {
        if (Gallery::where('order_id', '>=', $request->orderid)->where('parent', 0)->exists())
        {
            DB::update('Update gallery set gallery.order_id=gallery.order_id+1 where gallery.order_id>=?', [$request->orderid]);
        }

        $image = $request->file('image');
        $gallery = Gallery::find($request->id);
        $gallery->name = $request->name;
        if ($image)
        {
            Storage::delete('public/' . $gallery->path);
            $path = SliderHelper::saveImage($image);
            $gallery->path = $path[0] . $path[1];
        }
        $gallery->status = $request->status ? 1 : 0;
        $gallery->description = $request->description;
        $gallery->order_id = $request->orderid;
        $gallery->updated_at = now();
        $gallery->save();

        Alert::success('Başarılı', 'Veri güncelleme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->route('admin.gallery');
    }

        public function galleryEditOrder(Request $request)
    {
        $trID = $request->trID;
        $currentID = $request->currentID;
        $newID = $request->newID;

        DB::update('Update gallery set gallery.order_id=? where id=?', [$newID, $trID]);

        if ($currentID < $newID)
        { //1,3
            //2,3
            DB::update('Update gallery set gallery.order_id=gallery.order_id-1 where id<>? and parent=0 and gallery.order_id between ? and ?', [$trID, $currentID, $newID]);
        }
        else
        { //3,1
            //1,2
            DB::update('Update gallery set gallery.order_id=gallery.order_id+1 where id<>? and parent=0 and gallery.order_id between ? and ?', [$trID, $newID, $currentID]);
        }

        return response()->json(['status' => 'Başarılı'], 200);
    }

    public function subGalleryShow($id)
    {
        if (isset($id))
        {
            $gallery = Gallery::where('parent', $id)->orderBy('order_id', 'ASC')->paginate(8);
            $currentGallery = Gallery::where('id', $id)->first();
            if ($currentGallery)
            {
                return view('admin.sub_gallery', compact(['gallery', 'id', 'currentGallery']));
            }
            else
            {
                Alert::error('Hata!', 'Erişmeye çalıştığınız galeri bulunamadı.');
                return redirect()->route('admin.gallery');
            }
        }
    }


    public function subGalleryAdd(Request $request)
    {
        $exists = Gallery::find($request->parent);
        if ($exists)
        {
            $image = $request->file('image');
            $order = $request->orderid;
            $control = true;
            if ($image)
            {
                foreach ($image as $item)
                {
                    $imgName = $item->getClientOriginalName();
                    $extension = $item->getClientOriginalExtension();
                    $explode = explode('.', $imgName);
                    $imgName = $explode[0] . '_' . now()->format('d-m-Y_H-i-s') . '.' . $extension;
                    $publicPath = 'public/';
                    $path = 'dogaCiftlikImage/';
                    Storage::putFileAs($publicPath . $path, $item, $imgName);

                    Gallery::create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'order_id' => $control ? $order : ++$order,
                        'status' => isset($request->status) ? 1 : 0,
                        'path' => $path . $imgName,
                        'parent' => $request->parent
                    ]);
                    $control = false;
                    //Başlangıçta 1 kez order id'nin ilk değerini kaydetmesi amacıyla $control oluşturdum. Sonraki durumlarda
                    //Hep 1 artısını ekleyerek devam edecek.
                }
            }
        }
        else
        {
            Alert::error('Hata!', 'Kaydedilecek galeri bulunamadı.');
            return redirect()->route('admin.gallery');
        }
        Alert::success('Başarılı!', 'Veri kaydetme işlemi başarıyla gerçekleştirilmiştir.');
        return redirect()->back();

    }

    public function subGalleryUpdate(Request $request)
    {
        if (Gallery::where('order_id', '>=', $request->orderid)->exists())
        {
            DB::update('Update gallery set gallery.order_id=gallery.order_id+1 where gallery.order_id>=?', [$request->orderid]);
        }

        $image = $request->file('image');
        $gallery = Gallery::find($request->id);
        $gallery->name = $request->name;
        if ($image)
        {
            Storage::delete('public/' . $gallery->path);
            $path = SliderHelper::saveImage($image);
            $gallery->path = $path[0] . $path[1];
        }
        $gallery->status = $request->status ? 1 : 0;
        $gallery->description = $request->description;
        $gallery->order_id = $request->orderid;
        $gallery->updated_at = now();
        $gallery->save();

        Alert::success('Başarılı', 'Veri güncelleme işlemi başarılı şekilde gerçekleştirildi.');

        return redirect()->back();
    }


    public function subGalleryEditOrder(Request $request)
    {
        $trID = $request->trID;
        $currentID = $request->currentID;
        $newID = $request->newID;

        DB::update('Update gallery set gallery.order_id=? where id=?', [$newID, $trID]);

        if ($currentID < $newID)
        { //1,3
            //2,3
            DB::update('Update gallery set gallery.order_id=gallery.order_id-1 where id<>? and gallery.order_id between ? and ?', [$trID, $currentID, $newID]);
        }
        else
        { //3,1
            //1,2
            DB::update('Update gallery set gallery.order_id=gallery.order_id+1 where id<>? and gallery.order_id between ? and ?', [$trID, $newID, $currentID]);
        }

        return response()->json(['status' => 'Başarılı'], 200);
    }
}

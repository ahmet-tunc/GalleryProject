<?php


namespace App\Helper;


use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderHelper
{

    public static function saveImage($image)
    {
        $imgName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $explode = explode('.', $imgName);
        $imgName = $explode[0] . '_' . now()->format('d-m-Y_H-i-s') . '.' . $extension;
        $publicPath = 'public/';
        $path = 'dogaCiftlikImage/';
        Storage::putFileAs($publicPath.$path, $image, $imgName);

        return [$path,$imgName];
    }

    public static function setOrderID($orderid)
    {
        if(Slider::where('order_id','>=',$orderid)->exists())
        {
            DB::update('Update slider set slider.order_id=slider.order_id+1 where slider.order_id>=?', [$orderid]);
        }
    }
    


}

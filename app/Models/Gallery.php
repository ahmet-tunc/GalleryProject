<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = "gallery";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function scopeStatusActive($query)
    {
        return $query->where('gallery.status',1);
    }

    public function scopeGetParent($query)
    {
        return $query->where('parent',0);
    }
}

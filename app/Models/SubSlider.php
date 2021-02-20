<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSlider extends Model
{
    use HasFactory;
    protected $table = "SubSlider";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function scopeStatusActive($query)
    {
        return $query->where('subslider.status',1);
    }
}

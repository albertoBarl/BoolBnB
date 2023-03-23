<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Apartment;
use Illuminate\Support\Str;


class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
    // slug function
    public static function genSlug($param)
    {
        return Str::slug($param, "-");
    }
}

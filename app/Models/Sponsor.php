<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function genSlug($param)
    {
        return Str::slug($param, '-');
    }
    public function apartment()
    {
        return $this->hasMany(Apartment::class);
    }
}

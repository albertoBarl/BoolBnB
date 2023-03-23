<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = [];

    // slug function
    public static function genSlug($param)
    {
        return Str::slug($param, "-");
    }
}

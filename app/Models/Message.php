<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    protected $guarded = [];

    use HasFactory;

    public static function generateSlug($param)
    {
        return Str::slug($param, '-');
    }
}

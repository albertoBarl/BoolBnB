<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = ["apartment_id", "sponsor_id", "date_of_start", "date_of_end"];

    public static function genSlug($param)
    {
        return Str::slug($param, '-');
    }
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}

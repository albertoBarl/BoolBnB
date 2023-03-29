<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Sponsor;

class Apartment extends Model
{
    use HasFactory;
    protected $guarded = ["services"];

    // slug function
    public static function genSlug($param)
    {
        return Str::slug($param, "-");
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function sponsor(){
        return $this->belongsToMany(Sponsor::class);
    }
}

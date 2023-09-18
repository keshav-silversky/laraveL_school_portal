<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function setPdfAttribute($value)
    {
       $this->attributes['pdf'] = basename($value);      
    }
    public function getPdfAttribute($value)
    {
        return asset("storage/payment/$value");
    }
    public function getImageAttribute($value)
    {
        return asset("storage/course/$value");
    }
}

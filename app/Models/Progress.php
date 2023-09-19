<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function progress()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function getCertificateAttributes($value)
    {
        return asset("storage/payment/$value");
    }
    public function setCertificateAttribute($value)
    {
        $this->attributes['certificate'] = basename($value);
    }



}

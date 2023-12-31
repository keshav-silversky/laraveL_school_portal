<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    } // Right

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
    public function notices()
    {
        return $this->hasMany(Notice::class, 'course_id', 'course_id');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = "user";

    public function students()
    {
        return $this->belongsToMany(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class); 
    }
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } // Right
    public function payments()
    {
        return $this->hasMany(Payment::class);
    } // Right

    public function payment()
    {
        return $this->hasOne(Payment::class)->latest('id');
    } // Right



    public function notices()
    {
        return $this->hasMany(Notice::class);
    } // Right
    
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    } // Right
    public function progress()
    {
        return $this->hasOne(Progress::class)->latest('id');
    } // Right

    public function setImageAttribute($value)
    {
       $this->attributes['image'] = basename($value);      
    }
    public function getImageAttribute($value)
    {
        return asset("storage/course/$value");
    }


}

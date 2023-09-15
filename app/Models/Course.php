<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsToMany(User::class); 
    }


    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function setImageAttribute($value)
    {
       $this->attributes['image'] = basename($value);      
    }
    public function getImageAttribute($value)
    {
        return asset("storage/course/$value");
    }


}

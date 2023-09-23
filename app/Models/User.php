<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */




     protected $guarded = ['id'];

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function enroll()
    {
        return $this->belongsToMany(Course::class);
    } // right
    public function courses()
    {
        return $this->hasMany(Course::class);
    } // right

    public function paymentSum()
    {
        return $this->hasManyThrough(Payment::class, Course::class);
    }
 
    public function hasCourse(User $user,Course $course)
    {
     if($user->enroll()->where('course_id',$course->id)->exists())
     {
        return true;
     }
     else
     {
        return false;
     }
    }
    public function progress()
    {
        return $this->hasOne(Progress::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 
    //search 

    //search 



    public function setImageAttribute($value)
    {
       $this->attributes['image'] = basename($value);      
    }
    public function getImageAttribute($value)
    {
        return asset("storage/image/$value");
    }



    // public function setHobbiesAttribute($value)
    // {
    // }
  

    // public function progress()
    // {
    //     return $this->hasMany(Progress::class);
    // }

}

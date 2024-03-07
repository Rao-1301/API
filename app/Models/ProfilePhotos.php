<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePhotos extends Model
{
    use HasFactory;
    protected $table='profile_photos';
   
    protected $fillable = ['userID', 'profImg'];
    public function setUserID(){
       return $this->hasMany('App\Models\Relation','id','userID');
     }
}

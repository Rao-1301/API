<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePost extends Model
{
    use HasFactory;
    protected $table='manage_post';
   
     protected $fillable = ['userID', 'posts', 'caption', 'profImg'];
     public function setUser(){
        return $this->hasMany('App\Models\Relation','id','userID');
      }
      public function user()
      {
          return $this->belongsTo(User::class, 'userID');
      }
}

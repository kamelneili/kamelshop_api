<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' ,
         'content','title','category_id',
         'offre_date'
    ];
    public function user(){
        return $this->belongsTo( User::class );
    }
	 public function category(){
        return $this->belongsTo( Category::class );
    }

   // public function payment(){
    //    return $this->hasOne( Payment::class );
   // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class examResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'TResult',
        'PResult',
       
        
       
        
    ];

    public function user(){
        
        return $this->belongsTo(user::class);
    }

}

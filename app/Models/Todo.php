<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ; 

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;


    protected $fillable = [
        'user_id' , 
        'title' , 
        "description", 
        "status" , 
        "priority" , 
        "due_date" 
    ];


    public function user(){

        return  $this->belongsTo(User::class) ;  

    }

    
}

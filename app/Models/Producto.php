<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    //Query Scope
    public function scopeName($query, $name){
    	if($name){
    		return $query->where('nombre', 'LIKE', "%$name%");
    	}
    }

    public function scopeBio($query, $bio){
    	if($bio){
    		return $query->where('descripcion', 'LIKE', "%$bio%");
    	}
    }
}

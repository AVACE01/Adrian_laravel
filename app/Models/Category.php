<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //aqui ponemos las propiedades que no queremos que se asignen masivamente
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //aqui ponemos las propiedades quequeremos que se asignen masivamente
    // protected $fillable = ['title', 'description', 'user_id'];

    //relacion de 1 a muchos   (article - Category )
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}

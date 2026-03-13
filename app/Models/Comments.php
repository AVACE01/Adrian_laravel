<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    //aqui ponemos las propiedades que no queremos que se asignen masivamente
    protected $guarded = ['id', 'created_at', 'updated_at'];


    //relacion de 1 a muchos  inversa (comments - user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion de 1 a muchos   inversa (Comments - article)
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

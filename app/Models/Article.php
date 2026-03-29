<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    //aqui ponemos las propiedades que no queremos que se asignen masivamente
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relacion de 1 a muchos  inversa (article - user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion de 1 a muchos  inversa (article - comments)
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    //relacion de 1 a muchos  inversa (Category - article)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

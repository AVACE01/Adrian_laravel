<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //aqui ponemos las propiedades que no queremos que se asignen masivamente
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //aqui ponemos las propiedades que queremos que se asignen masivamente
    protected $fillable = [
        'photo',
        'profession',
        'about',
        'birthday',
        'twitter',
        'linkedin',
        'facebook',
        'user_id'
    ];

    //relacion de 1 a 1  inversa (profile a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion de 1 a muchos   (user - article)
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'imagem',
        'telefone',
        'user_id',
    ];

    public function post()
    {
        return $this->hasMany(Postagem::class);
    }
}

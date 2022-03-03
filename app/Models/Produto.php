<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'descricao',
        'quantidade',
        'imagem',
        'categoria_id '
    ];


    public function relCategorias()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'category_id');
    }
}

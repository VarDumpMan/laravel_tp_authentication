<?php

namespace App\Models;

use App\Models\Produit;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $created_at
 * @property string $updated_at
 * @property Produit[] $produits
 */
class Categorie extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nom', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany('App\Models\Produit');
    }
}

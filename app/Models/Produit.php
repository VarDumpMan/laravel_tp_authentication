<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;


/**
 * @property integer $id
 * @property integer $categorie_id
 * @property string $nom
 * @property string $description
 * @property integer $prix
 * @property string $created_at
 * @property string $updated_at
 * @property Categorie $categorie
 */
class Produit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['categorie_id', 'nom', 'description', 'prix', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }
}

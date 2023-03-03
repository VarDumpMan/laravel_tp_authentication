<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nom', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}


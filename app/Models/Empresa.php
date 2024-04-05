<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    //MUCHOA A MUCHOS
    public function tecnicos(): BelongsToMany
    {
        return $this->belongsToMany(Tecnico::class);
    }


    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class);
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }

    public function especies(): HasMany
    {
        return $this->hasMany(Especie::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'name',
        'precio',
        'is_visible'
    ];





    public function owner(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}

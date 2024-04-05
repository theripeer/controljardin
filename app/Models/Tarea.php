<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Ramsey\Uuid\v1;

class Tarea extends Model
{
    
    protected $fillable = [
        'empresa_id',
        'tecnico_id',
        'folio',
        'direccion',
        'especie',
        'servicio_id',
        'cant_servicios',
        'dap',
        'plazos',
        'est_fitosanitario',
        'image1',
        'image2',
        'estados',
        'estpago',
        'observacion',
        'image3',
        'image4'
    ];

    /*
    protected static function booted(): void
    {
        self::addGlobalScope('for_logged_tecnico', function (Builder $builder): void {
            if (auth()->guard('tecnico')->check()) {
                $builder->where('tecnico_id', auth()->id());
            }
        });

        self::saving(function (self $task): void {
            $task->tecnico_id = auth()->id();
        });

    }


    public function owner(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function tecnico(): BelongsTo
    {
        return $this->belongsTo(Tecnico::class);
    }
    */


    public function owner(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function tecnico(): BelongsTo
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function especie(): BelongsTo
    {
        return $this->BelongsTo(Especie::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->BelongsTo(Servicio::class);
    }

}

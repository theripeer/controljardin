<?php

namespace App\Models;

use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class Tecnico extends Authenticatable implements HasTenants
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'passsword',
        'remember_token',
    ];

    protected $cats = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class);
    }

    public function tareas(): BelongsToMany
    {
        return $this->belongsToMany(Tarea::class);
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->empresas()->get(); // Corregir llamada a empresas() y obtener resultados
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->empresas->contains($tenant);
    }
}

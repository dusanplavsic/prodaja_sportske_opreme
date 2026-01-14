<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkePorudzbine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'porudzbina_id',
        'proizvod_id',
        'kolicina',
        'cena_po_komadu',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'porudzbina_id' => 'integer',
            'proizvod_id' => 'integer',
        ];
    }

    public function porudzbina(): BelongsTo
    {
        return $this->belongsTo(Porudzbine::class);
    }

    public function proizvod(): BelongsTo
    {
        return $this->belongsTo(Proizvodi::class);
    }
}

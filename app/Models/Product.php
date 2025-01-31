<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'volume_id',
        'purchase_value',
        'sale_value',
        'promotion',
        'sold',
        'category',
        'barcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Caso você queira esconder algum campo ao serializar o modelo
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sold'           => 'boolean',   // Cast para boolean
        'purchase_value' => 'decimal:2', // Cast para decimal com 2 casas
        'sale_value'     => 'decimal:2', // Cast para decimal com 2 casas
        'promotion'      => 'decimal:2', // Cast para decimal com 2 casas
    ];

    /**
     * Relacionamento com a tabela volumes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }
}

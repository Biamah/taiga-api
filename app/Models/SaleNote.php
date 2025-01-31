<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_value',
        'sale_value',
        'sale_date',
        'product_id',
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
        'sale_date' => 'date', // Cast para o tipo date
        'purchase_value' => 'decimal:2', // Cast para decimal com 2 casas
        'sale_value' => 'decimal:2', // Cast para decimal com 2 casas
    ];

    /**
     * Relacionamento com a tabela products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
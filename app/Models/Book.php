<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'publication_date',
        'publisher_id',
        'target_audience_id',
        'category',
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
        'publication_date' => 'date', // Cast para o tipo date
    ];

    /**
     * Relacionamento com a tabela publishers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    /**
     * Relacionamento com a tabela target_audiences.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function targetAudience()
    {
        return $this->belongsTo(TargetAudience::class, 'target_audience_id');
    }
}

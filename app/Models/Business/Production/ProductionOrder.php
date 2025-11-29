<?php

namespace App\Models\Business\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductionOrder extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'production_orders';

    // PK é uuid "id"
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // CAMPOS QUE PODEM SER PREENCHIDOS PELO create()
    protected $fillable = [
        'order_date',
        'order_number',
        'client_name',
        'expedition_date',
        'status',
        'created_by_id',
        'stock_user_id',
        'production_user_id',
        'production_operator_name',
        'stock_separated_at',
        'production_started_at',
        'production_finished_at',
    ];

    // CASTS PARA DATA/DATETIME → vira Carbon no Eloquent
    protected $casts = [
        'order_date'             => 'date',
        'expedition_date'        => 'date',
        'stock_separated_at'     => 'datetime',
        'production_started_at'  => 'datetime',
        'production_finished_at' => 'datetime',
    ];

    // OFs não iniciadas
    public function scopeNotStarted($query)
    {
        return $query->where('status', 'not_started');
    }

    // OFs com material separado
    public function scopeSeparated($query)
    {
        return $query->where('status', 'separated');
    }

    // OFs em produção
    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
    }

    // OFs finalizadas (se quiser usar também)
    public function scopeFinished($query)
    {
        return $query->where('status', 'finished');
    }
}

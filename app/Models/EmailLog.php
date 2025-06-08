<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_type',
        'status',
        'recipient',
        'error_message'
    ];

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por emails enviados exitosamente
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    /**
     * Scope para filtrar por emails fallidos
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope para filtrar por tipo de email
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('email_type', $type);
    }

    /**
     * Obtener estadísticas de envío de emails
     */
    public static function getStats()
    {
        return [
            'total' => self::count(),
            'sent' => self::sent()->count(),
            'failed' => self::failed()->count(),
            'by_type' => self::selectRaw('email_type, count(*) as count')
                ->groupBy('email_type')
                ->get()
                ->pluck('count', 'email_type')
        ];
    }
}

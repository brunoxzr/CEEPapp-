<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaebProtocolo extends Model
{
    protected $table = 'saeb_protocolos';

    protected $fillable = [
        'admin_id',
        'arquivo',
        'dados',
        'publicado'
    ];

    protected $casts = [
        'dados' => 'array',
        'publicado' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relacionamento opcional com Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

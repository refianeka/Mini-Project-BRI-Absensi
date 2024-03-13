<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'class_id',
        'material_id',
        'assistant_id',
        'code_id',
        'teaching_role',
        'date',
        'start',
        'end',
        'duration',
        'created_at',
        'updated_at',

    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistant_id', 'id');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class, 'code_id', 'id');
    }
}

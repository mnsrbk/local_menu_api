<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'hall_id', 'status',  'reserve_time', 'is_active'];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}

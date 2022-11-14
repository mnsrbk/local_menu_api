<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'unit'];

    public function getCost()
    {
        if ($this->unit == 'manat') {
            return price_format($this->cost);
        }

        return $this->cost;
    }
}

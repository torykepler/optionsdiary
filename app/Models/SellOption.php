<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOption extends Model
{
    use HasFactory;

    public function getProfitAttribute()
    {
        return (($this->premium - $this->exit_price) * 100 - $this->fees);
    }
}

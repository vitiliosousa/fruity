<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function fruit() {
        return $this->belongsTo(Fruit::class);
    }
}

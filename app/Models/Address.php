<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryArea;

class Address extends Model
{
    use HasFactory;

    function deliveryArea() {
        return $this->belongsTo(DeliveryArea::class);
    }
}

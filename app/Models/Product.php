<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductOption;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    function category() : BelongsTo{
        return $this->belongsTo(Category::class);
    }

    function productImages() : HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    function productSize() : HasMany
    {
        return $this->hasMany(productSize::class);
    }

    function productOption() : HasMany
    {
        return $this->hasMany(productOption::class);
    }
}

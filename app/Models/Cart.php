<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Cart extends Model
{
    use HasFactory;

    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }
}

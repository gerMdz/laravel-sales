<?php

namespace App\Models;

use App\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $with = [
      'images'
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new AvailableScope);
        static::updated(function ($product){
            if($product->stock == 0 && $product->status == 'available' ){
                $product->status = 'unavailable';
                $product->save();
            }
        });
    }

    public function carts(): MorphToMany
    {
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function orders(): MorphToMany
    {
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeAvailable($query)
    {
        $query->where('status', 'available');
    }

    public function scopeUnavailable($query)
    {
        $query->where('status', 'unavailable');
    }

    public function getTotalAttribute()
    {
        return $this->pivot->quantity * $this->price;
    }


}

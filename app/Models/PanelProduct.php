<?php

namespace App\Models;

use App\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class PanelProduct extends Product
{
    use HasFactory;

    protected static function booted()
    {
//        static::addGlobalScope();
    }

    public function getForeignKey(): string
    {
        $parent = get_parent_class($this);
        return (new $parent)->getForeignKey();
    }

    public function getMorphClass(): string
    {
        $parent = get_parent_class($this);
        return (new $parent)->getMorphClass();
    }

}

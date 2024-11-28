<?php

namespace App\Traits\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    //         автоматичне створення slug при створенні моделі

    protected static function bootHasSlug():void
    {
        //автоматичного генерування унікального slug:
        static::creating(function ($product) {
            if (!$product->slug) {
                $product->slug = Str::slug($product->title) . '-' . uniqid();
            }
        });
    }

    // Поле для створення slug
    public static function slugFrom():string
    {
        return 'title';
    }
}

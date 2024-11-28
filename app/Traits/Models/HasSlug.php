<?php

namespace App\Traits\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    //         автоматичне створення slug при створенні моделі
    protected static function bootHasSlug():void
    {
        static::creating(function (Model $item) {
         //перевірка, якщо slug не задано. генеруємо його
            if(empty($item->slug)) {
                $source = $item->{static::slugFrom()} ?? '';
                $item->slug = Str::slug($source) . '-' . time();
            }
        });
    }

    // Поле для створення slug
    public static function slugFrom():string
    {
        return 'title';
    }
}

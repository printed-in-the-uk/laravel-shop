<?php

namespace Jskrd\Shop\Traits;

use Illuminate\Support\Str;

trait Slugifies
{
    public static function bootSlugifies(): void
    {
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}

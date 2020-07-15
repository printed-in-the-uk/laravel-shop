<?php

namespace Jskrd\Shop\Traits;

use Illuminate\Support\Str;

trait Slugifiable
{
    public static function bootSlugifiable(): void
    {
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}

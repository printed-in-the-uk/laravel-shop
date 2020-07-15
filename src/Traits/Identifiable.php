<?php

namespace Jskrd\Shop\Traits;

use Illuminate\Support\Str;

trait Identifiable
{
    public static function bootIdentifiable(): void
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function initializeIdentifiable(): void
    {
        $this->incrementing = false;

        $this->keyType = 'string';
    }
}

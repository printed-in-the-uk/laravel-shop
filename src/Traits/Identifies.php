<?php

namespace Jskrd\Shop\Traits;

use Illuminate\Support\Str;

trait Identifies
{
    public static function bootIdentifies(): void
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function initializeIdentifies(): void
    {
        $this->incrementing = false;

        $this->keyType = 'string';
    }
}

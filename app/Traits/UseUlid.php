<?php

namespace App\Traits;
use Ulid\Ulid;

trait UseUlid
{
    protected static function bootUseUlid()
    {
        static::creating(function ($model) {
            $model->id = (string) Ulid::generate(true);
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;

trait Uuid
{
    protected static function bootUuid()
    {
        static::creating(function ($obj) {
            $obj->uuid = Str::Uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
<?php

namespace App\Models;

class Permission extends Model
{
    protected $fillable = ['name'];

    public static function findById(int $id)
    {
        return static::where('id', $id)->first();
    }
}

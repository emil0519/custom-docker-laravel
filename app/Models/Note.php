<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
    ];

    public static function booted()
    {
        static::saving(function (Note $note) {
            $note->uuid ??= Str::uuid()->toString();
        });
    }
}

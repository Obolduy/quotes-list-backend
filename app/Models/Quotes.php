<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'text',
        'created_at',
        'updated_at',
    ];
}
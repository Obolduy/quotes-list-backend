<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsList extends Model
{
    use HasFactory;

    protected $table = 'tags_list';

    protected $fillable = [
        'tag_id',
        'quote_id',
        'created_at',
        'updated_at',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Image extends Model
{
    protected $fillable = [
        'type', 'path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $casts = [
        'price' => 'integer'
    ];

    public function users () {
        return $this->belongsToMany(User::class);
    }
}

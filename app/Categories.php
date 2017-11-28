<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    public function photos()
    {
        return $this->hasMany('App\Photos');
    }
}

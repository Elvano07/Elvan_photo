<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'categories_id', 'title', 'location', 'tag', 'description', 'filename', 'filelocation', 'download'
    ];   

    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Categories', 'categories_id');
    }
    
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
{
    return $this->belongsTo('App\User');
}
    protected $table = 'posts';
    // protected $fillable の配列を定義する
    protected $fillable = ['body'];
}

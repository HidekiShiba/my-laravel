<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    // protected $fillable の配列を定義する
    protected $fillable = ['body'];

    // relations のメソッドを作成する。https://readouble.com/laravel/7.x/ja/eloquent-relationships.html
}

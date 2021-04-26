<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); // integer を unsignedBigInteger へ変更。理由としては、users の increments の型は unsingedBigInteger である。
            $table->string('body');
            // $table->timestamps(); を使うと自動的に created_at と updated_at が追加される
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'))->nullable(); // 削除
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable(); //　削除

            // users テーブルと紐づけるのであれば、$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); を追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

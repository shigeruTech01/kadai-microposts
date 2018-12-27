<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToMicropostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_follow', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('follow_id')->unsigned()->index();
            
            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');
            
            // user_idとfollow_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'follow_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_follow', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('follow_id');
        });
    }
}

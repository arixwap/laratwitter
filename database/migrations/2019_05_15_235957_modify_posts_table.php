<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // $table->renameColumn('id_user', 'user_id');
            $table->dropColumn(['show_post', 'id_first_post']);
            // $table->renameColumn('id_parent_post', 'reply_post_id');
            $table->json('edit_history')->nullable()->after('content');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // $table->renameColumn('user_id', 'id_user');
            $table->boolean('show_post');
            $table->unsignedInteger('id_first_post');
            // $table->renameColumn('reply_post_id', 'id_parent_post');
            $table->dropColumn(['edit_history', 'deleted_at']);
        });
    }
}

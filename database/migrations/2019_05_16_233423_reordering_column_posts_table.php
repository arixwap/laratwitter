<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReorderingColumnPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('content', 'content');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('edit_history', 'edit_history');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('reply_post_id', 'reply_post_id');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('created_at', 'created_at');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('updated_at', 'updated_at');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('deleted_at', 'deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // nothing need to do for rollback reordering
    }
}

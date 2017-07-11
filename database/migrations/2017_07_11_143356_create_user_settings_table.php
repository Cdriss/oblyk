<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('partenaire')->nullable()->default(0);
            $table->boolean('dash_welcome')->nullable()->default(1);
            $table->boolean('dash_comments')->nullable()->default(0);
            $table->boolean('dash_crags')->nullable()->default(1);
            $table->boolean('dash_friend_cross')->nullable()->default(1);
            $table->boolean('dash_forum')->nullable()->default(0);
            $table->boolean('dash_list_crag_sae')->nullable()->default(0);
            $table->boolean('dash_my_cross')->nullable()->default(1);
            $table->boolean('dash_oblyk_news')->nullable()->default(1);
            $table->boolean('dash_partenaire')->nullable()->default(0);
            $table->boolean('dash_photos')->nullable()->default(0);
            $table->boolean('dash_routes')->nullable()->default(0);
            $table->boolean('dash_sae')->nullable()->default(0);
            $table->boolean('dash_topos')->nullable()->default(1);
            $table->boolean('dash_users')->nullable()->default(1);
            $table->boolean('dash_videos')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_settings');
    }
}

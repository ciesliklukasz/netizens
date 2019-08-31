<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->addColumn('string', 'source_id')
                ->nullable(false);
            $table->addColumn('string','fingerprint')
                ->nullable(false);
            $table->addColumn('integer', 'album_id')
                ->nullable()
                ->unsigned();
            $table->addColumn('string', 'title')
                ->nullable(false);
            $table->addColumn('string', 'url')
                ->nullable(false);
            $table->addColumn('string', 'thumbnail_url')
                ->nullable(false);
            $table->addColumn('string', 'author')
                ->nullable();
            $table->addColumn('string', 'description')
                ->nullable();
            $table->foreign('album_id')
                ->references('source_id')
                ->on('album')
                ->onDelete('cascade');
            $table->index(['id', 'album_id'], 'picture_album_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture');
    }
}

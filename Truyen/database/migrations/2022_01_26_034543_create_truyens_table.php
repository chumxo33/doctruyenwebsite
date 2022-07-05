<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truyens', function (Blueprint $table) {
            $table->id();
            $table->string('tentruyen');
            $table->string('tacgia');
            $table->text('tomtat');
            $table->integer('danhmuc_id');
            $table->integer('theloai_id');
            $table->string('image');
            $table->string('slug_truyen');
            $table->integer('kichhoat');
            $table->integer('truyen_noibat')->default('0');
            $table->integer('views');
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
        Schema::dropIfExists('truyens');
    }
}

<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChessFiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::beginTransaction();

        Schema::create('chess_figures', function (Blueprint $table) {
            $table->bigInteger('chess_figure')->unsigned();
            $table->bigInteger('figure_chess')->unsigned();
            $table->enum('color', ['white', 'black']);
        });

        Schema::table('chess_figures', function(Blueprint $table) {
            $table->foreign('chess_figure')->references('id')->on('chesses')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('figure_chess')->references('id')->on('figures')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::beginTransaction();

        Schema::table('chess_figures', function(Blueprint $table) {
            $table->dropForeign('chess_figures_chess_figure_foreign');
            $table->dropForeign('chess_figures_figure_chess_foreign');
        });

        Schema::dropIfExists('chess_figures');

        DB::commit();
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChessFiguresTable extends Migration
{
    protected $tableName = 'chess_figures';

    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {
        DB::beginTransaction();

        Schema::create($this->tableName, static function (Blueprint $table) {
            $table->bigInteger('figure_id')->unsigned();
            $table->bigInteger('chess_id')->unsigned();
        });

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->foreign('figure_id')->references('id')->on('color_figures')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('chess_id')->references('id')->on('chesses')->onDelete('CASCADE')->onUpdate('CASCADE');
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

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->dropForeign('chess_figures_figure_id_foreign');
            $table->dropForeign('chess_figures_chess_id_foreign');
        });

        Schema::dropIfExists('chess_figures');

        DB::commit();
    }
}

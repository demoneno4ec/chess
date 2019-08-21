<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorFiguresTable extends Migration
{
    protected $tableName = 'color_figures';

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
            $table->bigIncrements('id');
            $table->bigInteger('figure_id')->unsigned();
            $table->bigInteger('color_id')->unsigned();
        });

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->foreign('figure_id')->references('id')->on('figures')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function down(): void
    {
        DB::beginTransaction();

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->dropForeign('color_figures_figure_id_foreign');
            $table->dropForeign('color_figures_color_id_foreign');
        });

        Schema::dropIfExists($this->tableName);

        DB::commit();
    }
}

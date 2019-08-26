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
            $table->bigInteger('position_id')->unsigned();
        });

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->foreign('figure_id')->references('id')->on('figures')
                ->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->foreign('position_id')->references('id')->on('chess_position_lists')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
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

        Schema::table($this->tableName, function(Blueprint $table) {
            $table->dropForeign($this->tableName.'_figure_id_foreign');
            $table->dropForeign($this->tableName.'_position_id_foreign');
        });

        Schema::dropIfExists($this->tableName);

        DB::commit();
    }
}

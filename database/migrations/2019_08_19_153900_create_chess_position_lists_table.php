<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChessPositionListsTable extends Migration
{
    protected $tableName = 'chess_position_lists';

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
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('chess_id')->unsigned();
            $table->integer('sort')->unsigned();
        });

        Schema::table($this->tableName, static function (Blueprint $table) {
            $table->unique(['position_id', 'chess_id']);
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('chess_id')->references('id')->on('chesses')->onDelete('CASCADE')->onUpdate('CASCADE');
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
            $table->dropForeign($this->tableName.'_position_id_foreign');
            $table->dropForeign($this->tableName.'_chess_id_foreign');
        });

        Schema::dropIfExists($this->tableName);

        DB::commit();
    }
}

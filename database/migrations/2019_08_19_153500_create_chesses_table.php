<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChessesTable extends Migration
{
    protected $tableName = 'chesses';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->tableName, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique();
            $table->string('name_ru', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
}

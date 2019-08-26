<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesFiguresTable extends Migration
{
    protected $tableName = 'templates_figures';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::beginTransaction();

        Schema::create($this->tableName, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique();
            $table->string('name_ru', 100);
            $table->string('html_template', 100);
            $table->enum('template', ['default', 'custom'])->default('default');
        });

        Schema::table($this->tableName, static function (Blueprint $table) {
            $table->unique(['template', 'id']);
            $table->unique(['template', 'code']);
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
        Schema::dropIfExists($this->tableName);
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFigureTemplatesTable extends Migration
{
    protected $tableName = 'figure_templates';

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
            $table->bigInteger('template_id')->unsigned();
        });

        Schema::table($this->tableName, static function(Blueprint $table) {
            $table->unique(['figure_id', 'template_id']);
            $table->foreign('figure_id')->references('id')->on('figures')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('template_id')->references('id')->on('templates_figures')->onDelete('CASCADE')->onUpdate('CASCADE');
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
            $table->dropForeign($this->tableName.'_template_id_foreign');
        });

        Schema::dropIfExists($this->tableName);

        DB::commit();
    }
}

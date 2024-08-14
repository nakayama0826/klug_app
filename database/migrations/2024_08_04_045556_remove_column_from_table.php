<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnFromTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            $table->dropColumn('work_style1');
            $table->dropColumn('work_style2');
            $table->dropColumn('work_style3');
            $table->dropColumn('work_style4');
            $table->dropColumn('work_style5');
            $table->dropColumn('work_style6');
            $table->dropColumn('work_style7');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // カラムの再追加の際にデータ型を指定する必要があります
            $table->string('work_style1');
            $table->string('work_style2');
            $table->string('work_style3');
            $table->string('work_style4');
            $table->string('work_style5');
            $table->string('work_style6');
            $table->string('work_style7');
        });
    }
}

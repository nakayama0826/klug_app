<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeReportingDateToDatetimeInReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // 作業時間の入力欄を追加する
            $table->dateTime('reporting_time')->nullable();
            $table->string('work_style1')->nullable(); 
            $table->string('work_style2')->nullable(); 
            $table->string('work_style3')->nullable(); 
            $table->string('work_style4')->nullable(); 
            $table->string('work_style5')->nullable(); 
            $table->string('work_style6')->nullable(); 
            $table->string('work_style7')->nullable(); 
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
            // 作業時間の入力欄を削除する
            $table->dropColumn('reporting_time');
            $table->dropColumn('work_style1');
            $table->dropColumn('work_style2');
            $table->dropColumn('work_style3');
            $table->dropColumn('work_style4');
            $table->dropColumn('work_style5');
            $table->dropColumn('work_style6');
            $table->dropColumn('work_style7');

        });
    }
}
